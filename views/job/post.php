<?php require_once __DIR__ . '/../layout/header.php'; ?>
<div class="flex-center position-ref full-height">
    <div class="content">
        <?php if(isset($_SESSION['success'])) : ?>
            <div class="alert alert-success">
                <strong>Success!</strong> Job Saved Successfully!
            </div>
        <?php endif; ?>
        <?php if(isset($_SESSION['publish'])) : ?>
            <div class="alert alert-success">
                <strong>Success!</strong> Job Published Successfully!
            </div>
        <?php endif; ?>
        <?php if(isset($_SESSION['spam'])) : ?>
            <div class="alert alert-success">
                <strong>Success!</strong> Job Spammed Successfully!
            </div>
        <?php endif; ?>
        <form class="form-horizontal" method="post" action="/job/post">
            <fieldset>

                <!-- Form Name -->
                <legend>Submit Job</legend>

                <!-- Text input-->
                <div class="form-group <?php echo isset($errors['email']) ? 'error' : '' ?>">
                    <label class="col-md-4 control-label" for="email">Email</label>
                    <div class="col-md-8">
                        <input id="email" name="email" type="text" placeholder="email@example.com" class="form-control input-md" required="" value="<?php echo isset($data['email']) ? $data['email'] : '' ?>">
                        <span class="help-block"><?php echo isset($errors['email']) ? $errors['email'] : 'Your Email' ?></span>
                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group <?php isset($errors['title']) ? 'error' : '' ?>">
                    <label class="col-md-4 control-label" for="title">Title</label>
                    <div class="col-md-8">
                        <input id="title" name="title" type="text" placeholder="Job Title" class="form-control input-md" required="" value="<?php echo isset($data['title']) ? $data['title'] : '' ?>">
                        <span class="help-block"><?php echo isset($errors['title']) ? $errors['title'] : 'Your Job Title' ?></span>
                    </div>
                </div>

                <!-- Textarea -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="description">Job Description</label>
                    <div class="col-md-8">
                        <textarea class="form-control" id="description" name="description"><?php echo isset($data['description']) ? $data['description'] : '' ?></textarea>
                    </div>
                </div>

                <!-- Button -->
                <div class="form-group">
                    <div class="col-md-12">
                        <button id="submit" name="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>

            </fieldset>
        </form>
    </div>

</div>
<?php require_once __DIR__ . '/../layout/footer.php'; ?>