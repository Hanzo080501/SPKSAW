import { motion } from 'framer-motion';
import CarCard from '../components/CarCard';

const cars = [
  {
    id: 1,
    name: 'Tesla Model S',
    price: '$79,990',
    range: 652,
    acceleration: 3.1,
    image: '/images/tesla-model-s.jpg',
  },
  // Add more cars here
];

function Recommendations() {
  return (
    <div className="pt-16">
      <motion.div
        initial={{ opacity: 0 }}
        animate={{ opacity: 1 }}
        className="px-4 py-16 mx-auto max-w-7xl">
        <motion.div
          initial={{ opacity: 0, translateY: '100%' }}
          whileInView={{ opacity: 1, translateY: 0 }}
          transition={{ duration: 0.5 }}>
          <h1 className="mb-8 text-4xl font-bold">Electric Car Recommendations</h1>
        </motion.div>
        <div className="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
          {cars.map((car) => (
            <CarCard key={car.id} car={car} />
          ))}
        </div>
      </motion.div>
    </div>
  );
}

export default Recommendations;
