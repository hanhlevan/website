
</div>
    <!--Footer-->
    <footer class="page-footer text-center text-md-left stylish-color-dark pt-0">
        <!-- Copyright-->
        <div class="footer-copyright py-3 text-center">
            <div class="container-fluid">
                © 2019 Copyright: <a href="<?= site_url() ?>" target="_blank"> search </a>
            </div>
        </div>
        <!--/.Copyright -->
    </footer>
    <!--/.Footer-->
    <script>
        var prefixURL = "<?= base_url("home/read/") ?>";
        var count = <?= $count ?>;
        var posts = [];
        <?php foreach ($posts as $post): ?>
            var id = String.raw`<?= $post['id'] ?>`;
            var title = String.raw`<?= $post['title'] ?>`;
            var content = String.raw`<?= $post['content'] ?>`;
            posts.push({
                'id' : id,
                'title' : title,
                'content' : content,
            });
        <?php endforeach ?>
    </script>
    <?= $js ?>
    <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <script> var text = <?= '"'.$this->session->flashdata('message').'"' ?>; </script>
</body>
</html>
