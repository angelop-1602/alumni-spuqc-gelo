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
include ("header.php");
?>


<style>
    .row{
        margin:auto;
    }
    .card-header {
    background: #FFD63E;
    border-radius: 20px;
}
</style>
    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body "><?php echo "Welcome back " . $_SESSION['login_name'] . "!"; ?>
                    <hr>
                    <div class="row">
                        <!-- Basic Metrics -->
                        <div class="col-md-3 mb-3">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <span class="float-right summary_icon"><i class="fa fa-users"></i></span>
                                    <h4><b><?php echo $total_alumni; ?></b></h4>
                                    <p><b>Alumni</b></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card bg-info text-white">
                                <div class="card-body">
                                    <span class="float-right summary_icon"><i class="fa fa-comments"></i></span>
                                    <h4><b><?php echo $total_forum_topics; ?></b></h4>
                                    <p><b>Forum Topics</b></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card bg-warning text-white">
                                <div class="card-body">
                                    <span class="float-right summary_icon"><i class="fa fa-briefcase"></i></span>
                                    <h4><b><?php echo $total_jobs; ?></b></h4>
                                    <p><b>Posted Jobs</b></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <span class="float-right summary_icon"><i class="fa fa-calendar-day"></i></span>
                                    <h4><b><?php echo $total_events; ?></b></h4>
                                    <p><b>Upcoming Events</b></p>
                                </div>
                            </div>
                        </div>
                    </div>  
                    <div class="row">
    <div class="col-md-6 mb-3">
        <div class="card">
            <div class="card-body">
                <h5>Alumni by Batch</h5>
                <div class="chart-container">
                    <canvas id="alumniByBatchChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="card">
            <div class="card-body">
                <h5>Alumni by Program</h5>
                <div class="chart-container">
                    <canvas id="alumniByCourseChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="card">
            <div class="card-body">
                <h5>Employement of the Alumni</h5>
                <div class="chart-container">
                    <canvas id="currentlyEmployedChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>


                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card">
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

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {

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
</html>
