function getStores(elem){
   $.ajax({
     url:"php/_getStores.php",
     type:"POST",
     success:function(res){
       elem.html("");
       elem.append(
           '<option value="">... البيج ...</option>'
       );
       $.each(res.data,function(){
         elem.append("<option value='"+this.id+"'>"+this.name+"-"+this.client_name+"-"+this.client_phone+"</option>");
       });
       console.log(res);
     },
     error:function(e){
        elem.append("<option value='' class='bg-danger'>Error</option>");
        console.log(e);
     }
   });
}