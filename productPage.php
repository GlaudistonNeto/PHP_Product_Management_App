<!DOCTYPE html>
<html>
<head>
    <title>Add a Product</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/react/17.0.2/umd/react.development.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/react-dom/17.0.2/umd/react-dom.development.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-standalone/6.26.0/babel.min.js"></script>
</head>
<body>
    <div id="add-product"></div>

    <script type="text/babel">
        // AddProduct component
        function AddProduct() {
            const [name, setName] = React.useState('');
            const [price, setPrice] = React.useState('');

            function handleInputChange(event) {
                const target = event.target;
                const name = target.name;
                const value = target.value;

                if (name === 'name') {
                    setName(value);
                } else if (name === 'price') {
                    setPrice(value);
                }
            }

            function handleSubmit(event) {
                event.preventDefault();

                // Send the product data to the server
                fetch('save_product.php', {
                    method: 'POST',
                    body: JSON.stringify({ name, price })
                })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Product saved successfully:', data);
                        // Optionally, you can navigate back to the product list page
                        window.location.href = 'index.php';
                    })
                    .catch(error => console.error(error));
            }

            return (
                <div>
                    <h1>Add a Product</h1>
                    <form onSubmit={handleSubmit}>
                        <label htmlFor="name">Product Name:</label>
                        <input type="text" name="name" id="name" required onChange={handleInputChange} /><br /><br />

                        <label htmlFor="price">Price:</label>
                        <input type="number" name="price" id="price" step="0.01" required onChange={handleInputChange} /><br /><br />

                        <input type="submit" value="Add Product" />
                    </form>
                    <a href="index.php">Back to Product List</a>
                </div>
            );
        }

        // Render the AddProduct component
        ReactDOM.render(<AddProduct />, document.getElementById('add-product'));
    </script>
</body>
</html>
