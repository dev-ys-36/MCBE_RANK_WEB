<!DOCTYPE html>
<html>
<head>
    <title>마인크래프트 BE 한국 서버 목록</title>

    <meta charset="utf-8">
    <meta name="description" content="마인크래프트 BE 한국 서버 목록, 마인크래프트 PE 한국 서버 목록, 마인크래프트 BE 24시간 한국 서버 목록, 마인크래프트 PE 24시간 한국 서버 목록">

    <!-- Mobile browser viewport -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <!-- Google AdSense -->
    <script data-ad-client="ca-pub-4109567926919554" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-158697158-1"></script>
    <script>window.dataLayer = window.dataLayer || [];function gtag(){dataLayer.push(arguments);}gtag('js', new Date());gtag('config', 'UA-158697158-1');</script>

    <!--Bootstrap CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!--Bootstrap JS-->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <!-- Chart -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

    <!-- 차트 -->
    <!--
    <script>
    $(function() {
    var ctx = document.getElementById('myChart');
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
    type: 'line',
    data: {
    labels: [
    '00시', '01시', '02시', '03시', '04시',
    '05시', '06시', '07시', '08시', '09시',
    '10시', '11시', '12시'
    ],
    datasets: [{
    label: '',
    backgroundColor: 'transparent',
    borderColor: 'blue',
    data: ['0']
}]
},
options: {
legend: {
display: false
},
title: {
display : true,
text: '서버 동접 차트'
}
}
});
});
</script>
-->
<style>
.center {
    text-align: center;
}
.ce {
    width:800px;
    margin: 0 auto;
}
.card {
    margin: 0 auto;
}
</style>
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-primary navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="mcbe_logo" style="width: 170px; height:auto;">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/search">쿼리 검색하기</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/add">서버 추가하기</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="alert alert-primary" role="alert">
        <strong>사이트 문의는 <a href="https://open.kakao.com/o/siVsGWXb">이곳</a>을 클릭 해주세요!</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="container">
        <br/>
        <br/>
        <p>&nbsp;&nbsp;&nbsp;<small class="text-muted">배너를 클릭하면 해당 광고 사이트로 이동합니다..</small></p>
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="2500">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <a href="https://pf.kakao.com/_hxcyxnT"><img class="d-block w-100" src="rp_cloud" alt="First slide"></a>
                </div>
                <div class="carousel-item">
                    <a href="https://cafe.naver.com/mcbecafe"><img class="d-block w-100" src="kk_cafe" alt="Second slide"></a>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <br/>
        <br/>
        <?php

        include './utils/DataManager.php';

        $server = new utils\DataManager('/root/web/datas/server.json', utils\DataManager::JSON);
        $db['server'] = $server->getAll();

        $graph = new utils\DataManager('/root/web/datas/graph.json', utils\DataManager::JSON);
        $db['graph'] = $graph->getAll();

        $good = new utils\DataManager('/root/web/datas/good.json', utils\DataManager::JSON);
        $db['good'] = $good->getAll();

        foreach ($db['server']['online-server'] as $servers => $type){
            $a = explode("_*_", $type);
            if ($a[1] == $argv[1] and $a[2] == $argv[2]){
                echo '<div class="card mb-3" style="width: 500; height: auto; background-color: #EEEEEE;" >';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $a[3] . '</h5>';
                echo '<div align ="right"><div class="d-inline p-2 bg-primary text-white">' . $a[4] . '명 접속중</div></div>';
                echo '<br/>';
                echo '<br/>';
                if (isset($db['good'][$a[1] . ':' . $a[2]])){
                    echo '<div align ="right"><div class="d-inline p-2 bg-primary text-white">' . count($db['good'][$a[1] . ':' . $a[2]]['players']) . '명 추천함</div></div>';
                }else{
                    echo '<div align ="right"><div class="d-inline p-2 bg-primary text-white">' . '0' . '명 추천함</div></div>';
                }
                //echo '<div align ="left"><div class="d-inline p-2 bg-primary text-white">추천</div></div>';
                echo '<p class="card-text"><p class="font-weight-bold">' . $a[1] . ' : ' . $a[2] . '</p></p>';
                echo '<p class="font-weight-bold"><a href="minecraft://?addExternalServer=MCBE_SITE_ADD|' . $a[1] . ':' . $a[2] . '">자동으로 서버 추가하기</a></p>';
                echo '<p class="card-text"><small class="text-muted">Minecraft Bedrock Edition v' . $a[10] . ' : ' . $a[7] . '</small></p>';
                //echo '<img src="picture" style="max-width: 100%; height: auto; class="card-img-top">';
                //echo '<br/>';
                //echo '<br/>';
                if ($a[8] == ''){
                    echo '<a href="/not_enroll"><button type="button" class="btn btn-outline-success">밴드 가입</button></a>';
                }else{
                    echo '<a href=' . $a[8] . '><button type="button" class="btn btn-outline-success">밴드 가입</button></a>';
                }
                echo '&nbsp;&nbsp;&nbsp;';
                if ($a[9] == ''){
                    echo '<a href="/not_enroll"><button type="button" class="btn btn-outline-warning">플러스 친구</button></a>';
                }else{
                    echo '<a href=' . $a[9] . '><button type="button" class="btn btn-outline-warning">플러스 친구</button></a>';
                }
                echo '&nbsp;&nbsp;&nbsp;';
                echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#' .  explode('.', $a[1])[0] . '">기록</button>';
                echo '<div class="modal fade" id="' .  explode('.', $a[1])[0] . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLavel" aria-hidden="true">';
                echo '<div class="modal-dialog" role="document">';
                echo '<div class="modal-content">';
                echo '<div class="modal-header">';
                echo '<h5 class="modal-title" id="exampleModal">서버 기록..</h5>';
                echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
                echo '<span aria-hidden="true">&times;</span>';
                echo '</button>';
                echo '</div>';
                echo '<div class="modal-body">';
                echo '<div style="overflow:scroll; height:350px;">';
                //var_dump($data1[$a[1] . ':' . $a[2]]);
                foreach($db['graph'][$a[1] . ':' . $a[2]] as $ac => $b){
                    echo '+ ' . explode('_', explode(':', $b)[0])[0] . '시 ' . explode('_', explode(':', $b)[0])[1] . '분 : ' . explode(':', $b)[1] . '명 접속' . "<br/>";
                }
                //echo '<canvas id="myChart"></canvas>';
                echo '</div>';
                echo '</div>';
                echo '<div class="modal-footer">';
                echo '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
                //echo '<button type="button" class="btn btn-primary">Save changes</button>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '&nbsp;&nbsp;&nbsp;';
                echo '<a href="/good?ip=' . $a[1] . '&port=' . $a[2] . '">';
                echo '<button type="button" class="btn btn-primary">추천</button>';
                echo '</a>';
                echo '</div>';
                //echo '</a>';
                echo '</div>';
            }
        }
        ?>
    </div>
</body>
<br/>
<br/>
<br/>
<!-- footer -->
<div class="jumbotron text-center mt-5 mb-0">
    <h3 class="text-secondary">Kim Developer - MCBE</h3>
    <p>Coyright(C) 2020 <span class="text-primary">Kim_Developer</span>. All rights reserved.</p>
</div>
</html>
