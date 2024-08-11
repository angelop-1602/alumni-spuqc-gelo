<style>
    .side-bar {
        position: relative;
        top: 6rem;
        left: 12rem;
    }
    .side-bar .card {
        padding: 2rem;
        border-radius: 2rem;
    }

    .side-bar a {
        width: 11.8rem;
        font-size: 1.6rem;
    }

    @media only screen and (max-width: 1280px) {
        .side-bar {
            top: 6rem;
            left: 1rem;
        }
        .side-bar .card {
            padding: 1rem;
            border-radius: 1rem;
        }

        .side-bar a {
            width: 100%;
            font-size: 1.4rem;
        }
    }
    @media only screen and (max-width: 1280px) {
      .side-bar{
        display: none;
      }
    }
</style>
<div class="side-bar">
    <div class="card position-fixed">
        <ul class="list-group list-group-flush">
            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=article"><i
                    class="fas fa-newspaper"></i> Articles</a>
                <hr>
            </li>
            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=careers"><i
                    class="fas fa-briefcase"></i> Jobs</a>
                <hr>
            </li>
            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=forum"><i
                    class="fas fa-comments"></i> Forums</a></li>
        </ul>
    </div>
</div>