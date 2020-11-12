<div class="content">
    <div class="container-fluid">


      <?php

      echo $_SERVER['REQUEST_URI'];

      // echo $_SERVER['PATH_INFO'];

       ?>
        <div class="row">
          <div class="col-md-12">
              <h1>Heloo</h1>
          </div>
        </div>
        <form id="test">
          <input type="text" name="test"  data-jrule="required|min:8|max:12|hasCaps|noSpecialCharacter" value="">
          <input type="text" name="email" data-jrule="required|min:8|max:12|noCaps|hasSpecialCharacter" value="">
          <button type="submit" name="" >Send</button>
        </form>


        <table id="test-table">
          <thead>
            <th>id</th>
            <th>name</th>
          </thead>
          <tbody></tbody>
        </table>

        <div id="test-div" class=""></div>



    </div>
</div>


<script type="text/javascript">
$(document).ready(function(){
  $('#test-table').table({
    url:"/handleView",
    data:{
      per_page:5,
    },
    render:[
      function(data) {
          return data.id;
      },
      function(data) {
        return data.names;
      }
    ]

  })

  $('#test-div').renderDisplay({
    url:"/handleView",
    data:{
      per_page:5,
    },
    render:function(data) {
          const card =`
          <div class="card" style="width: 200px">
            <div class="card-header">
              <h4>${data.names}</h4>
            </div>
            <div class="card-body">
              ${data.id}
            </div>
          </div>
          `;

          return card;
      },

  })

  // $.onlySubmit({
  //   url:"/handleSend",
  //   data:{
  //     data:dat
  //   },
  //   callback:  function(data){
  //     console.log(data);
  //     $("body").append("callback");
  //   },
  //   doBefore:function(){
  //     $("body").append("before");
  //   },
  //   doAfter:function(){
  //     $("body").append("aftre");
  //   }
  // })

  $('#test').submitform({
    url:"/handleSend",
    additionalData:{
      data:"dadadada"
    },
    callback:  function(data){
        console.log(data);
        // $("body").append("callback");
    },
  })
})

</script>
