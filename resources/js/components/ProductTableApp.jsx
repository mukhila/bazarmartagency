// resources/js/components/ProductTableApp.jsx
import React, { useEffect, useState } from "react";

const ProductTableApp = () => {
  const [products, setProducts] = useState([]);
  const [cart, setCart] = useState({});
  const [isLoading, setIsLoading] = useState(true);
  const [error, setError] = useState(null);

  const [showCheckout, setShowCheckout] = useState(false);
  const [deliveryInfo, setDeliveryInfo] = useState({
    name: "",
    phone: "",
    address: "",
    email: "",
  });

  const minOrderAmount = 3500;

  // ---------- Fetch ----------
  const fetchProducts = async () => {
    setIsLoading(true);
    setError(null);
    try {
      const res = await fetch("/api/products", {
        headers: { Accept: "application/json" },
      });
      if (!res.ok) throw new Error(`HTTP ${res.status}`);
      const data = await res.json();
      setProducts(Array.isArray(data) ? data : data.products || []);
      setCart({});
    } catch (e) {
      console.error(e);
      setError("Failed to load products. Please try again.");

      // Fallback demo data
      setProducts([
        {
          id: 1,
          name: "7 CM ELECTRIC",
          description: "Electric sparkler",
          category: "Sparklers",
          product_type: "BOX",
          brand: "Premium",
          actual_price: 60.0,
          discounted_price: 6.0,
          unit: "Pcs",
          image:
            "https://www.sreevariagency.com/wp-content/uploads/2025/04/1P8A7293-150x150.jpg",
          content_per_container: "10 Pcs",
        },
        {
          id: 2,
          name: "10 CM GOLD",
          description: "Gold sparkler",
          category: "Sparklers",
          product_type: "BOX",
          brand: "Premium",
          actual_price: 120.0,
          discounted_price: 15.0,
          unit: "Pcs",
          image:
            "https://via.placeholder.com/150x150?text=Gold+Sparkler",
          content_per_container: "10 Pcs",
        },
        {
          id: 3,
          name: "FLOWER POT SMALL",
          description: "Small flower pot crackers",
          category: "Flower Pots",
          product_type: "BOX",
          brand: "Standard",
          actual_price: 80.0,
          discounted_price: 12.0,
          unit: "Pcs",
          image:
            "https://via.placeholder.com/150x150?text=Flower+Pot",
          content_per_container: "5 Pcs",
        },
      ]);
    } finally {
      setIsLoading(false);
    }
  };

  useEffect(() => {
    fetchProducts();
  }, []);

  // ---------- Totals ----------
  const calculateTotals = () => {
    let totalProducts = 0;
    let totalAmount = 0;
    let totalSavings = 0;

    Object.entries(cart).forEach(([id, qty]) => {
      if (qty > 0) {
        const p = products.find((x) => x.id === Number(id));
        if (p) {
          totalProducts += qty;
          totalAmount += (p.discounted_price || 0) * qty;
          totalSavings +=
            ((p.actual_price || 0) - (p.discounted_price || 0)) * qty;
        }
      }
    });

    return { totalProducts, totalAmount, totalSavings };
  };

  const { totalProducts, totalAmount, totalSavings } = calculateTotals();

  // ---------- Cart ops ----------
  const updateQuantity = (productId, change) => {
    setCart((prev) => {
      const current = prev[productId] || 0;
      const next = Math.max(0, current + change);
      return { ...prev, [productId]: next };
    });
  };

  // ---------- Grouping ----------
  const grouped = products.reduce((acc, p) => {
    const key = p.category || "Others";
    (acc[key] ||= []).push(p);
    return acc;
  }, {});

  // ---------- Checkout ----------
  const handleCheckout = () => {
    if (totalAmount < minOrderAmount) {
      alert(`Minimum order amount is ₹${minOrderAmount}`);
      return;
    }
    setShowCheckout(true);
  };

  const submitOrder = async () => {
    if (!deliveryInfo.name || !deliveryInfo.phone || !deliveryInfo.address) {
      alert("Please fill in all required fields");
      return;
    }

    const items = Object.entries(cart)
      .filter(([_, q]) => q > 0)
      .map(([id, q]) => {
        const p = products.find((x) => x.id === Number(id));
        return {
          product_id: p.id,
          name: p.name,
          quantity: q,
          price: p.discounted_price,
          total: (p.discounted_price || 0) * q,
        };
      });

    const payload = {
      customer: deliveryInfo,
      items,
      totals: {
        total_products: totalProducts,
        total_amount: totalAmount,
        total_savings: totalSavings,
      },
      order_date: new Date().toISOString(),
    };
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
    try {
      const res = await fetch("/api/orders", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          Accept: "application/json",
            "X-CSRF-TOKEN": token,
        },
        body: JSON.stringify(payload),
      });
      if (!res.ok) throw new Error("Order failed");
      await res.json();

      alert("Order submitted successfully!");
      setCart({});
      setShowCheckout(false);
      setDeliveryInfo({ name: "", phone: "", address: "", email: "" });
    } catch (e) {
      console.error(e);
      alert("Failed to submit order. Please try again.");
    }
  };

  // ---------- UI ----------
  if (isLoading) {
    return (
      <div className="container py-5 d-flex justify-content-center align-items-center" style={{ minHeight: "60vh" }}>
        <div className="text-center">
          <div className="spinner-border mb-3" role="status" aria-hidden="true" />
          <div className="fw-semibold">Loading Products…</div>
        </div>
      </div>
    );
  }

  return (
    <div className="container-fluid py-3">
      <div className="card shadow-sm border-0">
        {/* Header */}
        <div className="card-header text-white" style={{ backgroundColor: "#cd9043" }}>
          <div className="d-flex align-items-center justify-content-between">
            <h5 className="mb-0 fw-bold text-center" style={{ color: "#ffffff" }}>Shop Now — Product Catalog</h5>
            <div className="text-end">
            <button type="button" className="btn btn-light btn-sm" onClick={fetchProducts}>
              ↻ Refresh Products
            </button>
            </div>
          </div>
        </div>

        <div className="card-body">
          {error && (
            <div className="alert alert-danger" role="alert">
              <strong>Error:</strong> {error}
            </div>
          )}

          <div className="container-fluid border-top shadow-sm fixed-bottom py-2" style={{ zIndex: 1050, backgroundColor: "#ce132f" }}>

          {/* Summary */}
          <div className="row g-3 mb-3 bg-white" >
            <div className="col-12 col-md-3">
              <div className="border rounded p-3 text-center h-100">
                <div className="text-muted fw-bold">Total Products</div>
                <div className="fs-2 fw-bold text-primary">{totalProducts}</div>
              </div>
            </div>
            <div className="col-12 col-md-3">
              <div className="border rounded p-3 text-center h-100">
                <div className="text-muted fw-bold">Your Savings</div>
                <div className="fs-2 fw-bold text-success">₹{totalSavings.toFixed(2)}</div>
              </div>
            </div>
            <div className="col-12 col-md-3">
              <div className="border rounded p-3 text-center h-100">
                <div className="text-muted fw-bold">Total Amount</div>
                <div className="fs-2 fw-bold text-dark">₹{totalAmount.toFixed(2)}</div>
              </div>
            </div>
            <div className="col-12 col-md-3 d-flex flex-column justify-content-center">
              <button
                type="button"
                className="btn"
                style={{ backgroundColor: "#ce132f", borderColor: "#ce132f", color: "#ffffff" }}
                onClick={handleCheckout}
                disabled={totalAmount < minOrderAmount}
              >
                🛒 Checkout
              </button>
              <div className="normal text-muted mt-1 text-center">
                Min. ₹{minOrderAmount}
              </div>
            </div>
          </div>
</div>
          {/* Table */}
          {products.length > 0 ? (
            <div className="table-responsive">
              <table className="table align-middle">
                <thead className="table-light">
                  <tr>
                    <th style={{ width: "80px" }}>Image</th>
                    <th>Name</th>
                    <th>Package</th>
                    <th>Price</th>
                    <th className="text-center" style={{ width: "200px" }}>Quantity</th>
                    <th className="text-end">Total</th>
                  </tr>
                </thead>
                <tbody>
                  {Object.entries(grouped).map(([category, items]) => (
                    <React.Fragment key={category}>
                      <tr className="table-primary">
                        <td colSpan={6} className="fw-bold">{category}</td>
                      </tr>

                      {items.map((p) => {
                        const qty = cart[p.id] || 0;
                        const total = (p.discounted_price || 0) * qty;
                        const savings =
                          ((p.actual_price || 0) - (p.discounted_price || 0)) * qty;

                        return (
                          <tr key={p.id}>
                            <td>
                              <div className="rounded overflow-hidden border" style={{ width: 60, height: 60 }}>
                                <img
                                  src={p.image || "/assets/images/products/default.jpg"}
                                  alt={p.name}
                                  className="w-100 h-100"
                                  style={{ objectFit: "cover" }}
                                  onError={(e) => {
                                    e.currentTarget.src = "/assets/images/products/default.jpg";
                                  }}
                                />
                              </div>
                            </td>

                            <td>
                              <div className="fw-semibold">{p.name}</div>
                              {p.brand && (
                                <div className="text-muted small">{p.brand}</div>
                              )}
                              {/* Mobile-only price */}
                              <div className="d-md-none small mt-1">
                                {p.actual_price > p.discounted_price && (
                                  <span className="text-muted text-decoration-line-through me-2">
                                    ₹ {Number(p.actual_price).toFixed(2)}
                                  </span>
                                )}
                                <span className="fw-bold text-success">
                                  ₹ {Number(p.discounted_price).toFixed(2)}
                                </span>
                              </div>
                            </td>

                            <td>
                              <div className="fw-medium">{p.content_per_container}  {p.unit && (
                                <span className="text-muted small">  / {p.unit} </span>
                              )}</div>
                             
                            </td>

                            <td className="d-none d-md-table-cell">
                              {p.actual_price > p.discounted_price && (
                                <div className="text-muted small text-decoration-line-through">
                                  ₹{Number(p.actual_price).toFixed(2)}
                                </div>
                              )}
                              <div className="fw-bold text-success">
                                ₹{Number(p.discounted_price).toFixed(2)}
                              </div>
                            </td>

                            <td>
                              <div className="d-flex justify-content-center align-items-center gap-2">
                                <button
                                  type="button"
                                  className="btn btn-danger btn-sm rounded-circle d-flex align-items-center justify-content-center"
                                  style={{ width: 32, height: 32 }}
                                  onClick={() => updateQuantity(p.id, -1)}
                                  disabled={qty === 0}
                                  aria-label="Decrease"
                                  title="Decrease"
                                >
                                  −
                                </button>
                                <span className="fw-semibold" style={{ width: 36, textAlign: "center" }}>
                                  {qty}
                                </span>
                                <button
                                  type="button"
                                  className="btn btn-success btn-sm rounded-circle d-flex align-items-center justify-content-center"
                                  style={{ width: 32, height: 32 }}
                                  onClick={() => updateQuantity(p.id, +1)}
                                  aria-label="Increase"
                                  title="Increase"
                                >
                                  +
                                </button>
                              </div>
                            </td>

                            <td className="text-end">
                              <div className="fw-bold">₹{total.toFixed(2)}</div>
                              {savings > 0 && (
                                <div className="small text-success">Saved: ₹{savings.toFixed(2)}</div>
                              )}
                            </td>
                          </tr>
                        );
                      })}
                    </React.Fragment>
                  ))}
                </tbody>
              </table>
            </div>
          ) : (
            <div className="p-5 text-center text-muted">
              <div className="display-6 mb-2">🛒</div>
              <h6 className="mb-2">No Products Available</h6>
              <p className="mb-3">Please check back later or refresh the page</p>
              <button type="button" className="btn btn-primary" onClick={fetchProducts}>
                Refresh Products
              </button>
            </div>
          )}
        </div>
      </div>

      {/* Checkout Modal (React-controlled) */}
      {showCheckout && (
        <div className="modal d-block" tabIndex="-1" role="dialog" style={{ background: "rgba(0,0,0,.5)" }}>
          <div className="modal-dialog modal-dialog-centered" role="document">
            <div className="modal-content">
              <div className="modal-header">
                <h5 className="modal-title fw-bold">Delivery Information</h5>
                <button
                  type="button"
                  className="btn-close"
                  aria-label="Close"
                  onClick={() => setShowCheckout(false)}
                />
              </div>

              <div className="modal-body">
                <div className="mb-3">
                  <label className="form-label">Full Name *</label>
                  <input
                    type="text"
                    className="form-control"
                    value={deliveryInfo.name}
                    onChange={(e) => setDeliveryInfo((prev) => ({ ...prev, name: e.target.value }))}
                    placeholder="Enter your full name"
                    required
                  />
                </div>

                <div className="mb-3">
                  <label className="form-label">Phone Number *</label>
                  <input
                    type="tel"
                    className="form-control"
                    value={deliveryInfo.phone}
                    onChange={(e) => setDeliveryInfo((prev) => ({ ...prev, phone: e.target.value }))}
                    placeholder="Enter your phone number"
                    required
                  />
                </div>

                <div className="mb-3">
                  <label className="form-label">Email</label>
                  <input
                    type="email"
                    className="form-control"
                    value={deliveryInfo.email}
                    onChange={(e) => setDeliveryInfo((prev) => ({ ...prev, email: e.target.value }))}
                    placeholder="Enter your email (optional)"
                  />
                </div>

                <div className="mb-3">
                  <label className="form-label">Delivery Address *</label>
                  <textarea
                    className="form-control"
                    rows="3"
                    value={deliveryInfo.address}
                    onChange={(e) => setDeliveryInfo((prev) => ({ ...prev, address: e.target.value }))}
                    placeholder="Enter complete delivery address"
                    required
                  />
                </div>

                <hr />
                <div className="small">
                  <div className="d-flex justify-content-between">
                    <span>Total Products:</span>
                    <span>{totalProducts}</span>
                  </div>
                  <div className="d-flex justify-content-between">
                    <span>Total Amount:</span>
                    <span>₹{totalAmount.toFixed(2)}</span>
                  </div>
                  <div className="d-flex justify-content-between text-success">
                    <span>Your Savings:</span>
                    <span>₹{totalSavings.toFixed(2)}</span>
                  </div>
                </div>
              </div>

              <div className="modal-footer">
                <button type="button" className="btn btn-secondary" onClick={() => setShowCheckout(false)}>
                  Close
                </button>
                <button type="button" className="btn btn-primary" onClick={submitOrder} style={{ backgroundColor: "#ce132f", borderColor: "#ce132f", color: "#ffffff" }}>
                  Submit Order
                </button>
              </div>
            </div>
          </div>
        </div>
      )}
    </div>
  );
};



export default ProductTableApp;