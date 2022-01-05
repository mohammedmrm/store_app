function getCities(elem){
   $.ajax({
     url:"php/_getCites.php",
     type:"POST",
     success:function(res){
       elem.html("");
       elem.append(
           '<option value="">... المحافظة ...</option>'
       );
       $.each(res.data,function(){
         elem.append("<option value='"+this.id+"'>"+this.name+"</option>");
       });
       //elem.selectpicker('refresh');
       //console.log(res);
     },
     error:function(e){
        elem.append("<option value='' class='bg-danger'>خطأ اتصل بمصمم النظام</option>");
        console.log(e);
     }
   });
}