<!DOCTYPE html>
<html>
<head>
    <title>Codeigniter 4 Form Validation Example</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <br>
    <?= \Config\Services::validation()->listErrors(); ?>
    <?php if(session()->get('error')) { ?>
        <div class="alert alert-danger" role="alert">
            <?php echo session()->get('error') ?>
        </div>
    <?php } ?>
    <?php if(session()->get('success')) { ?>
        <div class="alert alert-success" role="alert">
            <?php echo session()->get('success') ?>
        </div>
    <?php } ?>

    <div class="row">
        <div class="col-md-9">
            <form action="<?php echo base_url('/') ?>" method="post" accept-charset="utf-8">

                <input name="category" id="category" value="" type="hidden">
                <div>
                <div class="form-group">
                    <label>Category</label>
                    <select class="form-control category">
                        <option value="">Main</option>
                        <?php foreach($categories as $row) { ?>
                            <option value="<?php echo $row['id'] ?>"> <?php echo $row['name'] ?></option>
                        <?php }?>
                    </select>

                </div>
                </div>
                <br/>

                <div class="form-group">
                    <label for="formGroupExampleInput">Name</label>
                    <input type="text" name="name" required class="form-control" id="formGroupExampleInput" placeholder="Please enter name">

                </div>


                <div class="form-group">
                    <button type="submit" id="send_form" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>

    </div>

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    var beginTemp='<div class="form-group"><label>Category</label><select class="form-control category">';
    var endTemp= '</select></div>';
    $(document).ready(function () {
    $(document).on('change','.category',function () {
        let item=$(this)
        let id=$(this).val();
        $(this).parent().nextAll().remove();
        $('#category').val(id)
        if($('option:selected', this).attr('data-value')=='first'){
            return false;
        }
        $.ajax({
            method: "POST",
            url: "<?php echo base_url('get-category') ?>",
            data: {
                category:id ,
            },
            success(data){
                let options='<option value="'+id+'" data-value="first">All</option>';
                let result=data.data;
                if(result.length>0){
                    for (let i=0;i<result.length;i++)
                        options+='<option value="'+result[i]['id']+'">'+result[i]['name']+'</option>'
                    item.parent().parent().append(beginTemp+options+endTemp);
                }
            }
        })


        });
    });
</script>
</body>
</html>