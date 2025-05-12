<style>
    .note-toolbar {overflow: initial;}
    .note-toolbar .dropdown-menu>li>a {
        padding: 3px 0;
        font-size: 15px;
    }
    .note-toolbar .dropdown-style>li>a {
        padding: 3px 12px;
    }
    .note-toolbar .dropdown-style {min-width: 240px !important;}
    .note-toolbar .note-table {min-width: max-content !important;}
</style>
<div class="container-fluid">
    <div class="row">
        
        <?php echo $this->session->flashdata('confirmation'); ?>
        
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panal-header-title ">
                    <h1 class="pull-left">Support</h1>
                </div>
            </div>

            <div class="panel-body">
                <?php echo form_open('support/sendEmail'); ?>
                
                <label class="control-label">Message</label>
                <textarea name="message" class="summernote form-control" style="margin-bottom: 20px;" rows="6" Placeholder="সফটওয়্যারের কোন সমস্যা বা নতুন কোন চাহিদা থাকলে এইখানে লিস্ট আকারে লিখে Submit করুন।&#10;১ ...........&#10;২ ........&#10;৩ ........&#10;"></textarea>
                
                <input type="submit" name="submit" value="Submit" class="btn btn-primary pull-right">
                
                <?php echo form_close(); ?>
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>

<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<script>
$(document).ready(function() {
  $('.summernote').summernote({
        placeholder: 'সফটওয়্যারের কোন সমস্যা বা নতুন কোন চাহিদা থাকলে এইখানে লিস্ট আকারে লিখে Submit করুন।',
        height: 300
  });
});
</script>

