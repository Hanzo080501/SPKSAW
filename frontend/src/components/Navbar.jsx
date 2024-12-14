import { Link } from 'react-router-dom';
import { motion } from 'framer-motion';
import { useState } from 'react';

function Navbar() {
  const [isMenuOpen, setIsMenuOpen] = useState(false);

  const toggleMenu = () => {
    setIsMenuOpen(!isMenuOpen);
  };

  return (
    <motion.nav
      initial={{ y: -100 }}
      animate={{ y: 0 }}
      className="fixed z-50 w-full bg-dark-secondary/80 backdrop-blur-md">
      <div className="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div className="flex items-center justify-between h-16">
          <Link to="/" className="text-2xl font-bold">
            ElectricAuto
          </Link>

          {/* Menu toggle button for mobile */}
          <div className="flex items-center lg:hidden">
            <button
              onClick={toggleMenu}
              className="text-gray-300 hover:text-white focus:outline-none">
              <svg
                className="w-6 h-6"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
                strokeWidth="2">
                {isMenuOpen ? (
                  <path strokeLinecap="round" strokeLinejoin="round" d="M6 18L18 6M6 6l12 12" />
                ) : (
                  <path strokeLinecap="round" strokeLinejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                )}
              </svg>
            </button>
          </div>

          {/* Menu links */}
          <div className="hidden space-x-8 lg:flex">
            <Link to="/" className="text-gray-300 transition-colors hover:text-white">
              Home
            </Link>
            <Link
              to="/recommendations"
              className="text-gray-300 transition-colors hover:text-white">
              Rekomendasi Mobil
            </Link>
            <Link to="/contact" className="text-gray-300 transition-colors hover:text-white">
              Contact
            </Link>
          </div>
        </div>
      </div>

      {/* Mobile menu */}
      {isMenuOpen && (
        <div className="px-4 pt-4 pb-2 space-y-4 lg:hidden bg-dark-secondary/90">
          <Link
            to="/"
            className="block text-gray-300 transition-colors hover:text-white"
            onClick={toggleMenu}>
            Home
          </Link>
          <Link
            to="/recommendations"
            className="block text-gray-300 transition-colors hover:text-white"
            onClick={toggleMenu}>
            Rekomendasi Mobil
          </Link>
          <Link
            to="/contact"
            className="block text-gray-300 transition-colors hover:text-white"
            onClick={toggleMenu}>
            Contact
          </Link>
        </div>
      )}
    </motion.nav>
  );
}

export default Navbar;
