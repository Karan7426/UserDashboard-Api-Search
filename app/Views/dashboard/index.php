<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .container { margin-top: 50px; }
        .nav a { margin-right: 15px; }
        .form-container, .search-container { display: none; }
        .search-results img { width: 100%; height: auto; border-radius: 8px; }

        .profile-pic {
    width: 150px; 
    height: 150px; 
    border-radius: 50%; 
    
}

    </style>
</head>
<body>
    <div class="container text-center">
       
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert" id="flash-message">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <h1>Welcome, <?= esc($user_name) ?></h1>
        <img src="<?= base_url('uploads/' . esc($user_picture)) ?>" class="profile-pic" alt="Profile Picture">
        <nav class="nav justify-content-center mt-4">
            <a href="#" class="btn btn-outline-primary" id="dashboard-btn">Dashboard</a>
            <a href="#update-profile" class="btn btn-outline-primary" id="update-profile-btn">Update Profile</a>
            <a href="<?= base_url('/dashboard') ?>" class="btn btn-outline-success" id="search-toggle">Search</a>
            <a href="<?= base_url('/logout') ?>" class="btn btn-outline-danger">Logout</a>
        </nav>

        <!-- Update Profile Form -->
        <div class="container form-container" id="update-profile-form">
            <h2 class="text-center mb-4">Update Profile</h2>
            <form method="post" action="<?= base_url('/profile/update') ?>" enctype="multipart/form-data">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control form-control-lg" id="name" name="name" value="<?= esc($user['name']) ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control form-control-lg" id="email" name="email" value="<?= esc($user['email']) ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="password">New Password (leave blank to keep current password)</label>
                            <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Enter new password">
                        </div>
                        <div class="form-group">
                            <label for="picture">Profile Picture</label>
                            <input type="file" class="form-control-file" id="picture" name="picture">
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary btn-lg">Update Profile</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Search Section -->
        <div class="container search-container">
            <h2 class="text-center mb-4">Search Pixabay</h2>
            <form id="search-form" class="text-center">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="search-query" placeholder="Search for images/videos" required>
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </div>
            </form>
            <div class="row search-results" id="search-results"></div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            
            $('#update-profile-form').hide();
            $('.search-container').hide();

           
            $('#update-profile-btn').click(function() {
                $('#update-profile-form').slideToggle();
                $('.search-container').hide(); 
            });

            
            $('#search-toggle').click(function(event) {
                event.preventDefault(); 
                var $searchContainer = $('.search-container');

                if ($searchContainer.is(':visible')) {
                    
                    $searchContainer.slideUp(function() {
                        $('#search-query').val(''); 
                        $('#search-results').empty(); 
                    });
                } else {
                    
                    $searchContainer.slideDown(function() {
                        $('#search-results').empty(); 
                    });
                    $('#update-profile-form').hide(); 
                }
            });

            
            $('#search-form').submit(function(event) {
                event.preventDefault();
                var query = $('#search-query').val();
                $.ajax({
                    url: '<?= base_url('/search') ?>',
                    method: 'POST',
                    data: { query: query },
                    success: function(response) {
                        $('#search-results').html(response).show();
                    },
                    error: function() {
                        $('#search-results').html('<p class="text-center">An error occurred while searching.</p>').show();
                    }
                });
            });

           
            setTimeout(function() {
                $('#flash-message').fadeOut('slow');
            }, 5000); 
        });
    </script>
</body>
</html>
