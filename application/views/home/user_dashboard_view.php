<section>
    <div class="row">
        <div class="card">
            <div class="card-body">
                <form action="<?php echo base_url('Annonces_Controller'); ?>" method="post">
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Branche concernée</label>
                        <div class="col-sm-10">
                            <select class="form-select" name="id" aria-label="Default select example">
                                <option selected>Choisir une branche</option>
                                <?php foreach ($branches as $branche): ?>
                                    <option value="<?php echo htmlspecialchars($branche->id); ?>">
                                        <?php echo htmlspecialchars($branche->nombranche); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
