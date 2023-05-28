<!DOCTYPE html>
<html>
<head>
    <title>Product List</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/react/17.0.2/umd/react.development.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/react-dom/17.0.2/umd/react-dom.development.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-standalone/6.26.0/babel.min.js"></script>
</head>
<body>
    <div id="product-list"></div>

    <script type="text/babel">
        // ProductList component
        class ProductList extends React.Component {
            constructor(props) {
                super(props);
                this.state = {
                    products: []
                };
            }

            componentDidMount() {
                // Fetch products from the server
                fetch('product_list.php')
                    .then(response => response.json())
                    .then(data => {
                        this.setState({ products: data });
                    })
                    .catch(error => console.error(error));
            }

            render() {
                const { products } = this.state;

                return (
                    <div>
                        <h1>Product List</h1>
                        {products.length > 0 ? (
                            <ul>
                                {products.map(product => (
                                    <li key={product.getId()}>
                                        {product.getName()} - ${product.getPrice()}
                                    </li>
                                ))}
                            </ul>
                        ) : (
                            <p>No products found.</p>
                        )}
                        <a href="add_product.php">Add a Product</a>
                    </div>
                );
            }
        }

        // Render the ProductList component
        ReactDOM.render(<ProductList />, document.getElementById('product-list'));
    </script>
</body>
</html>
