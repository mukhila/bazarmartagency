// resources/js/app.jsx
import React from 'react'
import ReactDOM from 'react-dom/client'
import './bootstrap'
import ProductTableApp from './components/ProductTableApp'

const mount = document.getElementById('app')
if (mount) {
  ReactDOM.createRoot(mount).render(<ProductTableApp />)
}
