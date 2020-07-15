$( document ).ready(function() {
    console.log( "ready!" );
$("#addComment").on("submit", function(e){
    e.preventDefault();

    var data = {};
    data["_token"] = $("input[name=_token]").val();
    data["author"] = $("#name").val();
    data["content"] = $("#content").val();

    if($("input[name=category_id]").length){
        data["category_id"] = $("input[name=category_id]").val()
    }
    else if($("input[name=post_id]").length){
        data["post_id"] = $("input[name=post_id]").val()
    }
    else{
        return;
        // never happen
    }


    $.ajax({
        url: "/addComment",
        method: 'post',
        data: data,
        dataType: "json",
        beforeSend: function( xhr ) {

        }
      })
        .done(function( data ) {
          if(data.status == 'ok'){
            console.log(data);

            var comment = "<div class='comment'>";
            comment += "<div class='author-name'>"+data.author+"</div>";
            comment += "<div class='comment-content'>"+$("#content").val()+"</div>";
            comment +="</div>";
            $("#comments").append(comment);
            $("#comment-status").html("");
            $("#name").val("")
            $("#content").val("")
          }else{

            console.log(data, 'error');
            var str = "<div class='error'>";
              for(var i in data.errors){
                var error = data.errors[i];

                 str += "<div>" + error + "</div>";
              }
              str+="</div>"
              $("#comment-status").html(str);
            console.log(str);
          }
        });
})

});
