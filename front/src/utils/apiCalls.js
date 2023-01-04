const getAllProducts = async () => {
  const response = await fetch("http://localhost:5000/products");
  const data = await response.json();
  return data;
};

const getProduct = async (id) => {
  const response = await fetch(`http://localhost:5000/products/${id}`);
  const data = await response.json();
  return data;
};

export { getAllProducts, getProduct };
