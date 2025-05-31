<!DOCTYPE html>
<html>
<head>
    <title>Simple Test Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        <h3>Simple Test Form</h3>
                    </div>
                    <div class="card-body">
                        <form action="<?= site_url('test/process') ?>" method="post">
                            <?= csrf_field() ?>
                            
                            <div class="mb-3">
                                <label for="test_name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="test_name" name="test_name" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="test_message" class="form-label">Message</label>
                                <textarea class="form-control" id="test_message" name="test_message" rows="3"></textarea>
                            </div>
                            
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Submit Test Form</button>
                            </div>
                        </form>
                        
                        <hr>
                        
                        <h4>Alternative Form (No CSRF)</h4>
                        <form action="<?= site_url('test/process') ?>" method="post" id="alt-form">
                            <div class="mb-3">
                                <label for="alt_name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="alt_name" name="alt_name" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="alt_message" class="form-label">Message</label>
                                <textarea class="form-control" id="alt_message" name="alt_message" rows="3"></textarea>
                            </div>
                            
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-secondary">Submit Without CSRF</button>
                            </div>
                        </form>
                        
                        <hr>
                        
                        <h4>JavaScript Form Submission</h4>
                        <form id="js-form">
                            <div class="mb-3">
                                <label for="js_name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="js_name" name="js_name" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="js_message" class="form-label">Message</label>
                                <textarea class="form-control" id="js_message" name="js_message" rows="3"></textarea>
                            </div>
                            
                            <div class="d-grid gap-2">
                                <button type="button" id="js-submit" class="btn btn-info">Submit via JavaScript</button>
                            </div>
                        </form>
                        
                        <script>
                        document.getElementById('js-submit').addEventListener('click', function() {
                            const formData = new FormData();
                            formData.append('js_name', document.getElementById('js_name').value);
                            formData.append('js_message', document.getElementById('js_message').value);
                            
                            console.log('Submitting via JavaScript...');
                            fetch('<?= site_url('test/process') ?>', {
                                method: 'POST',
                                body: formData
                            })
                            .then(response => response.text())
                            .then(html => {
                                document.body.innerHTML = html;
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('Error submitting form: ' + error);
                            });
                        });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
