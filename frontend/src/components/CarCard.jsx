import { motion } from 'framer-motion';
import { useNavigate } from 'react-router-dom';
import { useState, useEffect, useContext } from 'react';
import { SearchFilterContext } from '../context/SearchFilterContext';
import { fetchCars } from '../api/Api';

function CarCard() {
  const navigate = useNavigate();
  const { searchQuery, filteredCars, isLoading } = useContext(SearchFilterContext);
  const [cars, setCars] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    if (filteredCars.length === 0) {
      fetchCars()
        .then((data) => {
          setCars(data.data); // Anggap 'data' berisi daftar mobil
          setLoading(false);
        })
        .catch((err) => {
          setError(err.message);
          setLoading(false);
        });
    }
  }, [filteredCars]);

  const displayedCars = filteredCars.length > 0 ? filteredCars : cars;
  const isSearchQueryValid = searchQuery && searchQuery.trim().length > 0;

  const searchFilteredCars = displayedCars.filter((car) => {
    if (!isSearchQueryValid) return true;
    const carName = car.name ? car.name.toLowerCase() : '';
    const carBrand = car.brand ? car.brand.toLowerCase() : '';
    return (
      carName.includes(searchQuery.toLowerCase()) || carBrand.includes(searchQuery.toLowerCase())
    );
  });

  // Handle loading or error
  if (loading || isLoading) return <p>Loading...</p>;
  if (error) return <p>Error: {error}</p>;

  return (
    <div className="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
      {searchFilteredCars.length === 0 ? (
        <p>Tidak ada mobil yang ditemukan.</p>
      ) : (
        searchFilteredCars.map((car) => (
          <motion.div
            key={car.id}
            initial={{ opacity: 0, translateX: '100%' }}
            whileInView={{ opacity: 1, translateX: 0 }}
            transition={{ duration: 0.5 }}
            whileHover={{ scale: 1.05 }}
            whileTap={{ scale: 0.95 }}
            onClick={() => navigate(`/car/${car.id}`)}
            className="overflow-hidden rounded-lg cursor-pointer bg-dark-secondary">
            <div className="aspect-w-16 aspect-h-9">
              <img
                src={`http://127.0.0.1:8000/storage/${car.image}`}
                alt={car.name}
                className="object-cover w-full h-full"
              />
            </div>
            <div className="p-4">
              <h3 className="text-xl font-semibold">
                {car.brand} - {car.name}
              </h3>
              <p>
                {new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(
                  car.price
                )}
              </p>
              <div className="flex items-center mt-2 space-x-2 text-sm">
                <span>{car.range} km range</span>
                <span>•</span>
                <span>{car.top_speed} mph top speed</span>
                <span>•</span>
                <span>{car.ranking} Ranking</span>
              </div>
            </div>
          </motion.div>
        ))
      )}
    </div>
  );
}

export default CarCard;
