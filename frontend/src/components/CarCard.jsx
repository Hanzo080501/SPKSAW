import { motion } from 'framer-motion';
import { useNavigate } from 'react-router-dom';
import { useState, useEffect, useContext } from 'react';
import { fetchCars } from '../api/Api';
import { SearchFilterContext } from '../context/SearchFilterContext';

function CarCard() {
  const navigate = useNavigate();
  const { searchQuery, selectedPriceRange } = useContext(SearchFilterContext);

  const [cars, setCars] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    fetchCars()
      .then((data) => {
        setCars(data.data);
        setLoading(false);
      })
      .catch((err) => {
        setError(err.message);
        setLoading(false);
      });
  }, []);

  // Filter berdasarkan pencarian
  const searchFilteredCars = cars.filter(
    (car) =>
      car.name.toLowerCase().includes(searchQuery.toLowerCase()) ||
      car.brand.toLowerCase().includes(searchQuery.toLowerCase())
  );

  // Filter berdasarkan harga
  const priceFilteredCars = searchFilteredCars.filter((car) => {
    if (selectedPriceRange === 'low') return car.price < 200000000;
    if (selectedPriceRange === 'mid') return car.price >= 200000000 && car.price <= 500000000;
    if (selectedPriceRange === 'high') return car.price > 500000000;
    return true; // Tidak ada filter harga
  });

  // Sorting dan pemberian ranking
  const rankedCars = selectedPriceRange
    ? priceFilteredCars
        .sort((a, b) => a.price - b.price) // Sortir berdasarkan harga
        .map((car, index) => ({
          ...car,
          ranking: index + 1, // Ranking baru berdasarkan filter harga
        }))
    : searchFilteredCars.map((car, index) => ({
        ...car,
        ranking: car.ranking || index + 1, // Gunakan ranking asli jika tidak ada filter harga
      }));

  if (loading) return <p>Loading...</p>;
  if (error) return <p>Error: {error}</p>;

  return (
    <div className="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
      {rankedCars.map((car, index) => {
        const direction = Math.floor(index / 3) % 2 === 0 ? 1 : -1;
        return (
          <motion.div
            key={car.id}
            initial={{ opacity: 0, translateX: `${100 * direction}%` }}
            whileInView={{ opacity: 1, translateX: 0 }}
            transition={{ duration: 0.5 }}
            whileHover={{ scale: 1.05 }}
            whileTap={{ scale: 0.95 }}
            onClick={() => navigate(`/car/${car.id}`)}
            className="overflow-hidden rounded-lg cursor-pointer bg-dark-secondary">
            <div className="aspect-w-16 aspect-h-9">
              <img
                src={'http://127.0.0.1:8000/storage/' + car.image}
                alt={car.name}
                className="object-cover w-full h-full"
              />
            </div>
            <div className="p-4">
              <h3 className="text-xl font-semibold">
                {car.brand} - {car.name}
              </h3>
              <p className="text-gray-400">
                {new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(
                  car.price
                )}
              </p>
              <div className="flex items-center mt-2 space-x-2">
                <span className="text-sm text-gray-400">{car.range} km range</span>
                <span className="text-sm text-gray-400">•</span>
                <span className="text-sm text-gray-400">{car.top_speed} mph top speed</span>
                <span className="text-sm text-gray-400">•</span>
                <span className="text-sm text-gray-400">Ranking {car.ranking}</span>
              </div>
            </div>
          </motion.div>
        );
      })}
    </div>
  );
}

export default CarCard;
