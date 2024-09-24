<?php
include 'db_connect.php';

// Basic counts
$total_alumni_result = $conn->query("SELECT COUNT(*) as count FROM alumnus_bio WHERE status = 1");
$total_alumni = $total_alumni_result ? $total_alumni_result->fetch_assoc()['count'] : 0;

$total_forum_topics_result = $conn->query("SELECT COUNT(*) as count FROM forum_topics");
$total_forum_topics = $total_forum_topics_result ? $total_forum_topics_result->fetch_assoc()['count'] : 0;

$total_jobs_result = $conn->query("SELECT COUNT(*) as count FROM career");
$total_jobs = $total_jobs_result ? $total_jobs_result->fetch_assoc()['count'] : 0;

$total_events_result = $conn->query("SELECT COUNT(*) as count FROM events WHERE DATE_FORMAT(schedule, '%Y-%m-%d') >= '" . date('Y-m-d') . "'");
$total_events = $total_events_result ? $total_events_result->fetch_assoc()['count'] : 0;

// Upcoming events
$upcoming_events_result = $conn->query("SELECT title, schedule FROM events WHERE DATE_FORMAT(schedule, '%Y-%m-%d') >= '" . date('Y-m-d') . "' ORDER BY schedule ASC");
$upcoming_events = $upcoming_events_result ? $upcoming_events_result->fetch_all(MYSQLI_ASSOC) : [];

// Analytics data
$alumni_by_gender_result = $conn->query("SELECT gender, COUNT(*) as count FROM alumnus_bio WHERE status = 1 GROUP BY gender");
$alumni_by_gender = $alumni_by_gender_result ? $alumni_by_gender_result->fetch_all(MYSQLI_ASSOC) : [];

$alumni_by_batch_result = $conn->query("SELECT batch, COUNT(*) as count FROM alumnus_bio WHERE status = 1 GROUP BY batch");
$alumni_by_batch = $alumni_by_batch_result ? $alumni_by_batch_result->fetch_all(MYSQLI_ASSOC) : [];

$alumni_by_course_result = $conn->query("SELECT courses.course as course_name, COUNT(*) as count FROM alumnus_bio 
                                  JOIN courses ON alumnus_bio.course_id = courses.id 
                                  WHERE alumnus_bio.status = 1 GROUP BY courses.course");
$alumni_by_course = $alumni_by_course_result ? $alumni_by_course_result->fetch_all(MYSQLI_ASSOC) : [];

$current_employment_status_result = $conn->query("SELECT currentlyEmployed as employment_status, COUNT(*) as count FROM alumnus_bio 
                                                  WHERE status = 1 GROUP BY currentlyEmployed");
$current_employment_status = $current_employment_status_result ? $current_employment_status_result->fetch_all(MYSQLI_ASSOC) : [];

// Map the employment status
foreach ($current_employment_status as &$status) {
    $status['employment_status'] = $status['employment_status'] == 1 ? 'Employed' : 'Unemployed';
}

// Function to safely encode JSON
function safe_json_encode($value){
    return json_encode($value, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
}
?>
<?php
// Your PHP code for fetching data remains unchanged.
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni Analytics Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* General styling */
        body {
            background-color: #f4f6f9;
            font-family: Arial, sans-serif; /* Ensuring a clean font */
        }

        .container-fluid {
            padding: 20px; /* Adding some padding */
        }

        .card {
            border-radius: 12px;
            overflow: hidden; /* Ensuring contents are rounded */
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); /* Adding shadow for depth */
        }

        .summary_icon {
            font-size: 2.5rem;
            position: absolute;
            right: 1.5rem;
            top: 1.5rem;
            color: rgba(255, 255, 255, 0.7);
        }

        .card h4, .card p {
            margin: 0;
        }

        .card h4 {
            font-size: 2rem;
        }

        .card p {
            font-size: 1.2rem;
        }

        .chart-container {
            position: relative;
            height: 250px;
        }

        /* Customizing list group */
        .list-group-item {
            border: none;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 10px;
            background-color: #e9ecef;
        }

        /* Animation */
        .fade-in {
            animation: fadeIn 0.8s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        /* Responsive Styles */
        @media (min-width: 576px) {
            .card {
                margin-bottom: 20px; /* Spacing for larger screens */
            }
        }

        @media (min-width: 768px) {
            .summary-card {
                flex: 1 1 23%; /* Adjust card width for larger screens */
                margin: 10px; /* Spacing between cards */
            }

            .metrics-container {
                display: flex;
                flex-wrap: wrap;
            }
        }

        @media (min-width: 992px) {
            .chart-container {
                height: 300px; /* Increased chart height for larger screens */
            }
        }

        /* For desktop and larger screens */
        @media (min-width: 1200px) {
            .metrics-container {
                justify-content: space-between; /* Evenly space the cards */
            }
        }
    </style>
</head>
<body>
<div class="container-fluid fade-in">
    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="mb-3">Welcome back, <?php echo $_SESSION['login_name']; ?>!</h3>
                    <hr>
                    <div class="metrics-container">
                        <!-- Basic Metrics -->
                        <div class="summary-card">
                            <div class="card bg-primary text-white shadow-sm position-relative">
                                <div class="card-body">
                                    <span class="float-right summary_icon"><i class="fa fa-users"></i></span>
                                    <h4><b><?php echo $total_alumni; ?></b></h4>
                                    <p>Alumni</p>
                                </div>
                            </div>
                        </div>
                        <div class="summary-card">
                            <div class="card bg-info text-white shadow-sm position-relative">
                                <div class="card-body">
                                    <span class="float-right summary_icon"><i class="fa fa-comments"></i></span>
                                    <h4><b><?php echo $total_forum_topics; ?></b></h4>
                                    <p>Forum Topics</p>
                                </div>
                            </div>
                        </div>
                        <div class="summary-card">
                            <div class="card bg-warning text-white shadow-sm position-relative">
                                <div class="card-body">
                                    <span class="float-right summary_icon"><i class="fa fa-briefcase"></i></span>
                                    <h4><b><?php echo $total_jobs; ?></b></h4>
                                    <p>Posted Jobs</p>
                                </div>
                            </div>
                        </div>
                        <div class="summary-card">
                            <div class="card bg-success text-white shadow-sm position-relative">
                                <div class="card-body">
                                    <span class="float-right summary_icon"><i class="fa fa-calendar-day"></i></span>
                                    <h4><b><?php echo $total_events; ?></b></h4>
                                    <p>Upcoming Events</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Advanced Metrics -->
                    <div class="row mt-4">
                        <div class="col-md-3 mb-3">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5>Alumni by Gender</h5>
                                    <div class="chart-container">
                                        <canvas id="alumniByGenderChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5>Alumni by Batch</h5>
                                    <div class="chart-container">
                                        <canvas id="alumniByBatchChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5>Alumni by Program</h5>
                                    <div class="chart-container">
                                        <canvas id="alumniByCourseChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5>Currently Employed</h5>
                                    <div class="chart-container">
                                        <canvas id="currentlyEmployedChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5>Upcoming Events</h5>
                                    <ul class="list-group">
                                        <?php foreach ($upcoming_events as $event): ?>
                                            <li class="list-group-item">
                                                <b><?php echo $event['title']; ?></b> on <?php echo date('M d, Y', strtotime($event['schedule'])); ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>      
                </div>
            </div>              
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Alumni by Gender Chart
    var ctxGender = document.getElementById('alumniByGenderChart').getContext('2d');
    var alumniByGenderData = <?php echo safe_json_encode($alumni_by_gender); ?>;
    var alumniByGenderChart = new Chart(ctxGender, {
        type: 'pie',
        data: {
            labels: alumniByGenderData.map(item => item.gender),
            datasets: [{
                data: alumniByGenderData.map(item => item.count),
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'],
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                position: 'bottom',
            }
        }
    });

    // Alumni by Batch Chart
    var ctxBatch = document.getElementById('alumniByBatchChart').getContext('2d');
    var alumniByBatchData = <?php echo safe_json_encode($alumni_by_batch); ?>;
    var alumniByBatchChart = new Chart(ctxBatch, {
        type: 'bar',
        data: {
            labels: alumniByBatchData.map(item => item.batch),
            datasets: [{
                label: 'Number of Alumni',
                data: alumniByBatchData.map(item => item.count),
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Alumni by Course Chart
    var ctxCourse = document.getElementById('alumniByCourseChart').getContext('2d');
    var alumniByCourseData = <?php echo safe_json_encode($alumni_by_course); ?>;
    var alumniByCourseChart = new Chart(ctxCourse, {
        type: 'bar',
        data: {
            labels: alumniByCourseData.map(item => item.course_name),
            datasets: [{
                label: 'Number of Alumni',
                data: alumniByCourseData.map(item => item.count),
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Currently Employed Chart
    var ctxEmployed = document.getElementById('currentlyEmployedChart').getContext('2d');
    var currentEmploymentData = <?php echo safe_json_encode($current_employment_status); ?>;
    var currentlyEmployedChart = new Chart(ctxEmployed, {
        type: 'pie',
        data: {
            labels: currentEmploymentData.map(item => item.employment_status),
            datasets: [{
                data: currentEmploymentData.map(item => item.count),
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'],
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                position: 'bottom',
            }
        }
    });
});
</script>
</body>
</html>
