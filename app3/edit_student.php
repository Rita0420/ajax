  <div class="modal fade modal-lg" id="studentModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">編輯學生</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <div>
                            <label for="uni_id">學號</label>
                        </div>
                        <div>
                            <input type="text" name="uni_id" id="uni_id">
                        </div>

                        <div>
                            <label for="name">姓名</label>
                        </div>
                        <div>
                            <input type="text" name="name" id="name">
                        </div>

                        <div>
                            <label for="national_id">身分證字號</label>
                        </div>
                        <div>
                            <input type="text" name="national_id" id="national_id">
                        </div>

                        <div>
                            <label for="birthday">生日</label>
                        </div>
                        <div>
                            <input type="date" name="birthday" id="birthday">
                        </div>

                        <div>
                            <label for="classroom">班級</label>
                        </div>
                        <div>
                            <select name="classroom" id="classroom"></select>
                        </div>

                        <div>
                            <label for="seat_num">座號</label>
                        </div>
                        <div>
                            <input type="text" name="seat_num" id="seat_num">
                        </div>

                        <div>
                            <label for="major">主修科目</label>
                        </div>
                        <div>
                            <input type="text" name="major" id="major">
                        </div>

                        <div>
                            <label for="secondary">畢業國中</label>
                        </div>
                        <div>
                            <input type="text" name="secondary" id="secondary">
                        </div>

                        <div>
                            <label for="parent">家長姓名</label>
                        </div>
                        <div>
                            <input type="text" name="parent" id="parent">
                        </div>

                        <div>
                            <label for="address">地址</label>
                        </div>
                        <div>
                            <input type="text" name="address" id="address">
                        </div>

                        <div>
                            <label for="telphone">電話</label>
                        </div>
                        <div>
                            <input type="text" name="telphone" id="telphone">
                        </div>
                </div>
                <div class="modal-footer">
                    <div class="form-buttons">
                        <button type="button" onclick="add()">送出</button>
                    </div>
                    <input type="hidden" name="id" id="<?=$_GET['id'];?>">
                </div>
                </form>
            </div>
        </div>
    </div>
<script>

let urlParams= new URLSearchParams(window.location.search);
let id=urlParams.get('id');


/* let url=location.search.replace('?','').split('&');
let params={};
url.forEach(item=>{
    let tmp=item.split("=");
    params[tmp[0]]=tmp[1];
})
console.log(params); */
//let id = url.split('=')[1]; // 取得 URL 中的 id 參數
//console.log(id);

function classroomMenu(classroom){
  $.get("./api/classroom.php",function(classrooms){
    classrooms.forEach(item=>{
      let selected=(item.classroom == classroom)?'select':'';
      $('#classroom').append(`<option value="${item.classroom}" ${selected}>${item.name}</option>`);
    })
  })
}

function getStudent(id){
  console.log(id);
  
  $.get("./api/get_student.php",{id},function(student){
    console.log(student);
    
      $('#uni_id').val(student.uni_id);
      $('#name').val(student.name);
      $('#national_id').val(student.national_id);
      $('#birthday').val(student.birthday);
      // $('#classroom').val(student.classroom);
      $('#seat_num').val(student.seat_num);
      $('#major').val(student.major);
      $('#secondary').val(student.secondary);
      $('#parent').val(student.parent);
      $('#address').val(student.address);
      $('#telphone').val(student.telphone);
      $('#id').val(student.id);
      classroomMenu(student.classroom);
  })
}


function edit(){
    let data= {
        uni_id : $('#uni_id').val(),
        name : $('#name').val(),
        national_id : $('#national_id').val(),
        birthday : $('#birthday').val(),
        classroom : $('#classroom').val(),
        seat_num : $('#seat_num').val(),
        major : $('#major').val(),
        secondary : $('#secondary').val(),
        parent : $('#parent').val(),
        address : $('#address').val(),
        telphone : $('#telphone').val(),    
        id : $('#id').val(),
    }

    $.post("./api/save_student.php",data,function(res){
        if(res.success){
            alert("編輯成功");
            location.href="index.html";
        }else{
            alert("編輯失敗" + res.message);
        }
    })
}
</script>
</body>
</html>