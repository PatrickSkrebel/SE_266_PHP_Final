<!-- For Stlying on this page only -->
<style>

    /* styles the table */
    .data {
        width: 100%;
        border-collapse: collapse; /* Collapses the border */
    }

    .data, .data th, .data td {
        border: 1px solid #ddd; /* Adds border to table, th, and td */
    }

    .data th, .data td {
        padding: 8px; /* Adds padding inside each th and td */
        text-align: left; /* Aligns text to the left */
    }

    .data th {
        background-color: #f2f2f2; /* Sets background color for the header */
        color: #333; /* Sets text color for the header */
    }

    .data tr:nth-child(even) {
        background-color: #f9f9f9; /* Sets background color for even rows */
    }

    .data tr:hover {
        background-color: #eaeaea; /* Adds a hover effect for rows */
    }

    /* user style */
    .user-gap{
        margin-right: 10px;
    }

   .east-button {
        background-color: #007BFF; /* Blue background */
        color: white; /* Readable text color */
        padding: 5px 10px; /* Padding around text */
        border: none; /* No border */
        cursor: pointer; /* Cursor changes to pointer to indicate it's clickable */
        transition: background-color 0.3s; /* Smooth transition for background color */
        border-radius: 5px; /* Slightly rounded corners */
        text-decoration: none; /* Remove underline */
    }

    .east-button:hover {
        background-color: #0056b3; /* Lighten up the background color on hover */
    }

    .west-button {
        background-color: #FF4136; /* Red background */
        color: white; /* Readable text color */
        padding: 5px 10px; /* Padding around text */
        border: none; /* No border */
        cursor: pointer; /* Cursor changes to pointer to indicate it's clickable */
        transition: background-color 0.3s; /* Smooth transition for background color */
        border-radius: 5px; /* Slightly rounded corners */
        text-decoration: none; /* Remove underline */
    }

    .west-button:hover {
        background-color: #B6143E; /* Lighten up the background color on hover */
    }

    .league-button {
        /* Diagonal gradient from bottom-left to top-right */
        background: linear-gradient(to top right, #007BFF 50%, #FF4136 50%);
        color: white; /* Readable text color */
        padding: 5px 10px; /* Padding around text */
        border: none; /* No border */
        cursor: pointer; /* Cursor changes to pointer to indicate it's clickable */
        transition: background-color 0.3s; /* Transition effect */
        border-radius: 5px; /* Slightly rounded corners */
        font-size: 16px; /* Text size */
        text-align: center; /* Ensure text is centered */
        display: inline-block; /* Needed to apply the gradient properly */
        text-decoration: none; /* Remove underline */
    }

    .league-button:hover {
        /* Lighten the colors on hover with the same diagonal direction */
        background: linear-gradient(to top right, #3399ff 50%, #ff6347 50%);
    }
</style>

<!-- main php scripts -->
<?php
session_start();

    include __DIR__ . "/model/functions.php";
    include __DIR__ . '/../include/header.php'; 
    
    $TeamName = "";
    $Conference = "";
    $league = "";
    
    
    if(isset($_GET["Conference"])){
        $Conference = filter_input(INPUT_GET, "Conference");
    }

    
    if(isset($_GET["East/West"])){
        $league = filter_input(INPUT_GET, "East/West");

    }

    
    if(isset($_POST["logoutBtn"])){
        session_unset(); 
        session_destroy();
    }

    $teams = searchConference($Conference);
    $team = getStandings();

    $rank = 0;

    //$people = getPeople();
?>



        <!-- Page content-->
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Post content-->
                    <article>
                        <!-- Post header-->
                        <header class="mb-4">
                            <!-- Post title-->
                            <h1 class="fw-bolder mb-1">NBA Stangings</h1>
                            <!-- Post meta content-->
                            <!-- <div class="text-muted fst-italic mb-2">Posted on January 1, 2023 by Start Bootstrap</div> -->
                            <!-- Post categories-->
                            <!--<h2>Selected Conference: League <?php echo $Conference; ?></h2>-->

                            <a class="league-button" href="?East/West=League">League</a>
                            <a class="east-button" href="?Conference=East" >East</a>
                            <a class="west-button" href="?Conference=West" >West</a>                            
                        </header>

                        <!-- Post content-->
                        <div class="">

<div class="data">
     <!-- Begin table of teams -->
     <table class="data">
    <thead>
        <tr>           
            <!-- Display The column rows --> 
            <th>Rank</th>
            <th>Team Name</th>
            <th>City</th>              
            <th>Conference</th>
            <th>Wins</th>
            <th>Losses</th>
            <th>Pct</th>
            <?php if(isset($_SESSION['user'])): ?>
                <th>Edit</th>
            <?php else: ?>
               
            <?php endif; ?>

            <!-- make this appear when you log in -->
        </tr>
    </thead>
    <tbody>

    


    <?php foreach ($teams as $t): ?>
        
        <?php $rank++ ?>
        <tr class="team-row">     
            <td> <?= $rank ?></td>   
            <td><?= $t['TeamName'];?></td>
            <td><?= $t['City'];?></td>                
            <td><?= $t['Conference'];?></td>
            <td><?= $t['wins'];?></td>
            <td><?= $t['losses'];?></td>
            <td><?= $t['win_percentage'];?></td>
            <?php if(isset($_SESSION['user'])): ?> <!-- When a user logins in this will check it -->
                <td><a href="edit_TeamWins.php?action=Update&teamID=<?= $t['TeamID']; ?>" class="edit-link">Edit</a></td><!-- Edit appears be able to change the teams wins or loss -->
            <?php else: ?> <!-- This could be an error message or a redirect page. -->
                    <!-- Code -->
            <?php endif; ?><!-- End statement -->

        </tr>
    <?php endforeach; ?> <!-- End foreach -->
    
    </table>

    </br>
    <!--<a href="edit_TeamWins.php?action=Add">Add New Team</a>-->
</div>
</div>
                    </article>
                    <!-- This is grom giscos.com that connects to github for comments -->
                    <script src="https://giscus.app/client.js"
                        data-repo="PatrickSkrebel/NBA-StatPlus"
                        data-repo-id="R_kgDOK1o1kw"
                        data-category="General"
                        data-category-id="DIC_kwDOK1o1k84CeF8v"
                        data-mapping="pathname"
                        data-strict="0"
                        data-reactions-enabled="1"
                        data-emit-metadata="0"
                        data-input-position="bottom"
                        data-theme="preferred_color_scheme"
                        data-lang="en"
                        crossorigin="anonymous"
                        async>
                    </script>
                <p>Only Users Who Have A GitHub Can Comment</p>
                </div>
                <!-- Side widgets-->
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-header">User Info</div>
                        <div class="card-body">
                            <div class="input-group">                                
                                <?php if(isset($_SESSION['user'])): ?>
                                    <form method="POST" name="logout" class="logout">
                                        <input type="submit" name="logoutBtn" value="Logout">
                                    </form>

                                <?php else: ?>
                                    <button class="user-gap"><a class="nav-link" href="../User/login.php">Login</a></button>
                                    <button class="nav-item"><a class="nav-link" href="../User/signup.php">Sign Up</a></button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                  
                    <!-- Search widget-->
                    <div class="card mb-4">
                        <div class="card-header">Search</div>
                        <div class="card-body">
                            <div class="input-group">
                                <input class="form-control" type="text" placeholder="Enter search term..." aria-label="Enter search term..." aria-describedby="button-search" />
                                <button class="btn btn-primary" id="button-search" type="button">Go!</button>
                            </div>
                        </div>
                    </div>
                    <!-- Categories widget-->
                    <div class="card mb-4">
                        <div class="card-header">Categories</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <ul class="list-unstyled mb-0">
                                        <li><a href="#!">Web Design</a></li>
                                        <li><a href="#!">HTML</a></li>
                                        <li><a href="#!">Freebies</a></li>
                                    </ul>
                                </div>
                                <div class="col-sm-6">
                                    <ul class="list-unstyled mb-0">
                                        <li><a href="#!">JavaScript</a></li>
                                        <li><a href="#!">CSS</a></li>
                                        <li><a href="#!">Tutorials</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Side widget-->
                    <div class="card mb-4">
                        <div class="card-header">Side Widget</div>
                        <div class="card-body">You can put anything you want inside of these side widgets. They are easy to use, and feature the Bootstrap 5 card component!</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Stat+ 2023</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS
        <script src="js/scripts.js"></script>
        -->
    </body>
</html>
