<form id="addform">
    <div class="form-row">
        <div class="form-group col-md-6">
            <label>Nom</label>
            <input type="text" class="form-control" placeholder="ex: VTT Rockrider..." required>
        </div>
        <div class="form-group col-md-6">
            <label>Image</label>
            <input type="text" class="form-control" placeholder="Image (ex: images/....png)" required>
        </div>
    </div>
    <div class="form-group">
        <label>Description</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
    </div>
    <div class="form-row">
        <div class="form-group col-md-2">
            <label>Catégorie</label>
            <input type="text" class="form-control" placeholder="ex: Rockrider" required>
        </div>
        <div class="form-group col-md-2">
            <label>Prix</label>
            <input type="text" class="form-control" placeholder="ex: 3000">
        </div>
    </div>
    <div class="form-row">
        <button type="submit" class="btn btn-success">Ajouter</button>
        <button type="submit" class="btn btn-primary">Revenir aux produits</button>
    </div>

</form>