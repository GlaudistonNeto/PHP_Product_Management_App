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
        class AddProduct extends React.Component {
            constructor(props) {
                super(props);
                this.state = {
                    name: '',
                    price: ''
                };
            }

            handleInputChange(event) {
                const target = event.target;
                const name = target.name;
                const value = target.value;

                this.setState({
                    [name]: value
                });
            }

            handleSubmit(event) {
                event.preventDefault();

                // Send the product data to the server
                fetch('save_product.php', {
                    method: 'POST',
                    body: JSON.stringify(this.state)
                })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Product saved successfully:', data);
                        // Optionally, you can navigate back to the product list page
                        window.location.href = 'index.php';
                    })
                    .catch(error => console.error(error));
            }

            render() {
                return (
                    <div>
                        <h1>Add a Product</h1>
                        <form onSubmit={this.handleSubmit.bind(this)}>
                            <label htmlFor="name">Product Name:</label>
                            <input type="text" name="name" id="name" required onChange={this.handleInputChange.bind(this)} /><br /><br />

                            <label htmlFor="price">Price:</label>
                            <input type="number" name="price" id="price" step="0.01" required onChange={this.handleInputChange.bind(this)} /><br /><br />

                            <input type="submit" value="Add Product" />
                        </form>
                        <a href="index.php">Back to Product List</a>
                    </div>
                );
            }
        }

        // Render the AddProduct component
        ReactDOM.render(<AddProduct />, document.getElementById('add-product'));
    </script>
</body>
</html>
