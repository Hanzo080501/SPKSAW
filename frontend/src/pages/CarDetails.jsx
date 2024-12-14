import { motion } from 'framer-motion';
import { useParams } from 'react-router-dom';
import { useState, useEffect } from 'react';
import { fetchDetails } from '../api/ShowApi';

function CarDetails() {
  const { id } = useParams();
  const [cars, setCar] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  // Mengambil data mobil berdasarkan ID
  useEffect(() => {
    fetchDetails(id)
      .then((data) => {
        setCar(data);
        console.log(data);
        setLoading(false);
      })
      .catch((err) => {
        setError(err.message);
        setLoading(false);
      });
  }, [id]);

  if (loading) return <p>Loading...</p>;
  if (error) return <p>Error: {error}</p>;

  return (
    <div className="pt-16">
      <motion.div
        initial={{ opacity: 0 }}
        animate={{ opacity: 1 }}
        className="max-w-7xl mx-auto px-4 py-16">
        <motion.h1
          initial={{ y: 50, opacity: 0 }}
          animate={{ y: 0, opacity: 1 }}
          className="text-4xl font-bold mb-8">
          {cars.data.brand} {cars.data.name} Details
        </motion.h1>
        <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
          <motion.div
            initial={{ scale: 0.8, opacity: 0 }}
            animate={{ scale: 1, opacity: 1 }}
            className="aspect-w-16 aspect-h-9">
            <img
              src={'http://127.0.0.1:8000/storage/' + cars.data.image}
              alt={cars.name}
              className="w-full h-full object-cover rounded-lg"
            />
          </motion.div>
          <motion.div
            initial={{ x: 50, opacity: 0 }}
            animate={{ x: 0, opacity: 1 }}
            className="space-y-4">
            <h2 className="text-2xl font-semibold">Specifications</h2>
            <div className="grid grid-cols-2 gap-4">
              <div>
                <p className="text-gray-400">Range</p>
                <p className="text-xl">{cars.data.range} km</p>
              </div>
              <div>
                <p className="text-gray-400">Dealer Availability</p>
                <p className="text-xl">{cars.data.dealer_availability} </p>{' '}
              </div>
              <div>
                <p className="text-gray-400">Top Speed</p>
                <p className="text-xl">{cars.data.top_speed} km/h</p>{' '}
              </div>
              <div>
                <p className="text-gray-400">Charging Time</p>
                <p className="text-xl">{cars.data.charging_time} mt</p>{' '}
              </div>
              <div>
                <p className="text-gray-400">Spare Part Availability</p>
                <p className="text-xl">{cars.data.spare_part_availability}</p>{' '}
              </div>
              <div>
                <p className="text-gray-400">Drive Type</p>
                <p className="text-xl">{cars.data.drive_type}</p>{' '}
              </div>
              <div>
                <p className="text-gray-400">Battery Type</p>
                <p className="text-xl">{cars.data.battery_type}</p>{' '}
              </div>
              <div>
                <p className="text-gray-400">Price</p>
                <p className="text-xl">
                  {new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(
                    cars.data.price
                  )}
                </p>{' '}
              </div>
            </div>
          </motion.div>
        </div>
      </motion.div>
    </div>
  );
}

export default CarDetails;
