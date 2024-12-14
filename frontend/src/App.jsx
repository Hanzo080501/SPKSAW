import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import Navbar from './components/Navbar';
import Home from './pages/Home';
import Recommendations from './pages/Recommendations';
import Contact from './pages/Contact';
import CarDetails from './pages/CarDetails';

function App() {
  return (
    <Router>
      <div className="min-h-screen bg-dark-primary">
        <Navbar />
        <Routes>
          <Route path="/" element={<Home />} />
          <Route path="/recommendations" element={<Recommendations />} />
          <Route path="/contact" element={<Contact />} />
          <Route path="/car/:id" element={<CarDetails />} />
        </Routes>
      </div>
    </Router>
  );
}

export default App;
