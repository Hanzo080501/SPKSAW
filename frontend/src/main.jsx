import { StrictMode } from 'react';
import { createRoot } from 'react-dom/client';
import './index.css';
import App from './App.jsx';
import { SearchFilterProvider } from './context/SearchFilterContext.jsx';

createRoot(document.getElementById('root')).render(
  <SearchFilterProvider>
    <StrictMode>
      <App />
    </StrictMode>
  </SearchFilterProvider>
);
