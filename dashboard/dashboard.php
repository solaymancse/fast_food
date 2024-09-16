<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Document</title>
</head>

<body>
    <input type="checkbox" name="" id="menu-toggle">
    <div class="overlay"><label for="menu-toggle">
        </label></div>
    <div class="sidebar">
        <div class="sidebar-container">
            <div class="brand">
                <h3>
                    <span class="lab la-staylinked"></span>
                    vase
                </h3>
            </div>
            <div class="sidebar-avatar">
                <div>
                    <img src="https://media-exp1.licdn.com/dms/image/C4D03AQF9R2lxnH4fOw/profile-displayphoto-shrink_800_800/0/1639841285929?e=1654128000&v=beta&t=QvocDiNfivbaAzHjsX9fnl9eFa1ZSo4SBHeH4jZANEk" alt="avatar">
                </div>
                <div class="avatar-info">
                    <div class="avatar-text">
                        <h4>maz develop</h4>
                        <small>14-10-69</small>
                    </div>
                    <span class="las la-angle-double-down"></span>
                </div>
            </div>
            <div class="sidebar-menu">
                <ul>
                    <li><a href="#" class="active"><span class="las la-adjust"></span><span>Dashboard</span></a></li>
                    <li><a href="./restaurant.php"><span class="las la-video"></span><span>Restaurant</span></a></li>
                    <li><a href="#"><span class="las la-chart-bar"></span><span>Analytics</span></a></li>
                    <li><a href="#"><span class="las la-calendar"></span><span>Schedule</span></a></li>
                    <li><a href="#"><span class="las la-user"></span><span>Account</span></a></li>
                </ul>
            </div>
            <div class="sidebar-card">
                <div class="side-card-icon">
                    <span class="lab la-codiepie"></span>
                </div>
                <div>
                    <h4>Make AdSense</h4>
                    <p>add ads to your videos to earn money</p>
                </div>
                <button class="btn btn-main btn-block">Create now</button>
            </div>
        </div>
    </div>
    <div class="main-content">
        <header>
            <div class="header-wrapper">
                <label for="menu-toggle">
                    <span class="las la-bars"></span>
                </label>
                <div class="header-title">
                    <h1>Analytics</h1>
                    <p>Display analytics about your Channel <span class="las la-chart-line"></span></p>
                </div>
            </div>
            <div class="header-action">
                <button class="btn btn-main">
                    <span class="las la-video"></span>
                    Upload
                </button>
            </div>
        </header>
        <main>
            <section>
                <h3 class="section-head">Overview</h3>
                <div class="analytics">
                    <div class="analytic">
                        <div class="analytic-icon"><span class="las la-eye"></span></div>
                        <div class="analytic-info">
                            <h4>Total views</h4>
                            <h1>10.3M</h1>
                        </div>
                    </div>
                    <div class="analytic">
                        <div class="analytic-icon"><span class="las la-clock"></span></div>
                        <div class="analytic-info">
                            <h4>Watch time (hrs)</h4>
                            <h1>20.9k <small class="text-danger">5%</small></h1>
                        </div>
                    </div>
                    <div class="analytic">
                        <div class="analytic-icon"><span class="las la-users"></span></div>
                        <div class="analytic-info">
                            <h4>Subscribers</h4>
                            <h1>1.3k <small class="text-success">12%</small></h1>
                        </div>
                    </div>
                    <div class="analytic">
                        <div class="analytic-icon"><span class="las la-heart"></span></div>
                        <div class="analytic-info">
                            <h4>Total likes</h4>
                            <h1>3.4M </h1>
                        </div>
                    </div>
                </div>
            </section>
            <section>
                <div class="block-grid">
                    <div class="revenue-card">
                        <h3 class="section-head">Total Revenue</h3>
                        <div class="rev-content">
                            <img src="https://media-exp1.licdn.com/dms/image/C4D03AQF9R2lxnH4fOw/profile-displayphoto-shrink_800_800/0/1639841285929?e=1654128000&v=beta&t=QvocDiNfivbaAzHjsX9fnl9eFa1ZSo4SBHeH4jZANEk" alt="profile">
                            <div class="rev-info">
                                <h3>Mohsen Alizade</h3>
                                <h1>3.5M <small>Subscribers</small></h1>
                            </div>
                            <div class="rev-sum">
                                <h4>Total income</h4>
                                <h2>$70.859</h2>
                            </div>
                        </div>
                    </div>
                    <div class="graph-card">
                        <h3 class="section-head">Graph</h3>
                        <div class="graph-content">
                            <div class="graph-head">
                                <div class="icon-wrapper">
                                    <div class="icon"><span class="las la-eye text-main"></span></div>
                                    <div class="icon"><span class="las la-clock text-success"></span></div>
                                </div>
                                <div class="graph-select">
                                    <select name="" id="">
                                        <option value="">Septamber</option>
                                    </select>
                                </div>
                            </div>
                            <div class="graph-board">
                                <canvas id="revenueChart" width="100%"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <script src="./script.js"></script>
</body>

</html>