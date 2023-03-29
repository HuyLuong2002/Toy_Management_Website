<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/newProduct.css" />

    <title>CreateNewProduct</title>
</head>

<body>
    <div class="form-container">
        <form>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" id="price" name="price" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" required></textarea>
            </div>

            <div class="form-group">
                <label for="category">Category</label>
                <select id="category" name="category" required>
                    <option value="">Select category</option>
                    <option value="electronics">Electronics</option>
                    <option value="clothing">Clothing</option>
                    <option value="books">Books</option>
                </select>
            </div>

            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" id="quantity" name="quantity" required>
            </div>

            <div class="form-group">
                <label for="uploadfile">Upload File</label>
                <input type="file" id="uploadfile" name="uploadfile">
            </div>

            <button type="submit">Submit</button>
        </form>
    </div>

</body>

</html>