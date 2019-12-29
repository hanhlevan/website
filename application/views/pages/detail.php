    <!-- Main Container -->
    <div class="container mt-5 pt-3">
     <!--Navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark blue lighten-2 mb-4">
            <!-- Navbar brand -->
            <a class="navbar-brand" href="<?= site_url() ?>">Science News</a>

            <!-- Collapse button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span
                class="navbar-toggler-icon"></span></button>

            <!-- Collapsible content -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Links -->                
                <form class="form-inline input-group pl-auto" method="get" action="<?= site_url() ?>">
                    <input class="form-control" type="text" name="query" value="<?= $query ?>" placeholder="Search" aria-label="Search">
                    <button class="btn btn-mdb-color btn-rounded btn-sm my-0 ml-sm-2" type="submit">Search</button>
                </form>
            </div>
        </nav>
        <!--/.Navbar-->
        <div class="row" id="listContent">
            <!-- Content -->
            <div class="col-lg-12">
                <!-- Filter Area -->
                <div class="row">
                    <div class="col-md-10 mt-3">
                        <div id="load"> </div>                        
						<h5> <?= $count ?> kết quả tìm kiếm với từ khóa "<strong><?= $query ?></strong>"</h5>
                        <p> Thời gian tìm kiếm: <?= round($search_time, 3) ?>s</p>
                    </div>
                </div>
                <!-- /.Filter Area -->
                <!-- Products Grid -->
                <section class="section" id="contents">
                  <h3 class="text-center mt-4 mb-4"><?= $title ?></h3>
                  <?php foreach ($paragraphs as $paragraph): ?>
                    <div class="col-md-12">
                      <p class="contentOne"><?= $paragraph ?></p>
                    </div>
                  <?php endforeach ?>
                </section>
                <!-- /.Products Grid -->
            </div>
            <!-- /.Content -->
        </div>
    </div>
    <!-- /.Main Container -->