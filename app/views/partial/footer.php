<!-- footer content -->
        <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
    </div>
  </div>
  <!-- jQuery -->
    <script src="<?php echo base_url()?>assets/admin/js/app.js"></script>
    <script src="<?php echo base_url()?>assets/admin/js/style.js"></script>
    <script src="<?php echo base_url()?>assets/admin/js/sweetalert2.min.js"></script>
    <script src="<?php echo base_url()?>assets/admin/js/printThis.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url()?>assets/admin/js/form.js"></script>
    <?php
    if (isset($datatables) and $datatables) { ?>
      <script src="<?php echo base_url()?>assets/admin/js/tables.js"></script>
    <?php } ?>

    <?php if(isset($javascript) and $javascript) echo $javascript; ?>
    
</body>
</html>