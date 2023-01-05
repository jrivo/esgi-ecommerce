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

const login = async (email, password) => {
  const response = await fetch("http://localhost/auth", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({ email, password }),
  });
  console.log("Response", response);
  const data = await response.json();
  console.log("Login data", data);
  return data;
};

export { getAllProducts, getProduct, login };
