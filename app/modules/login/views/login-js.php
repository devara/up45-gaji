<script type="text/javascript">
$('#forget_btn').click(function(e){
	var action = 'forget';
  $.ajax({
    type  : "POST",
    url   : "<?php echo base_url()?>login/action_form",
    dataType : "json",
    data : {act:action},
    beforeSend: function(){
      $("#loading").html(loader_green);
    },
    success: function(response){
      $("#loading").html("");
      if (response[0].code==200) {
        $("#action-box").html(response[0].form);
        
      }
      else{
        $("#loading").html(alert_red(response[0].message));
      }
    }
  });
  e.preventDefault();
});

</script>