import { motion } from 'framer-motion';
import CarCard from '../components/CarCard';
import Filter from '../components/Filter';

function Recommendations() {
  return (
    <div className="min-h-screen pt-16">
      <motion.div
        initial={{ opacity: 0 }}
        animate={{ opacity: 1 }}
        className="px-4 py-16 mx-auto max-w-8xl">
        <motion.div
          initial={{ opacity: 0, translateY: '100%' }}
          whileInView={{ opacity: 1, translateY: 0 }}
          transition={{ duration: 0.5 }}>
          <h1 className="mb-8 text-4xl font-bold">Electric Car Recommendations</h1>
        </motion.div>

        <div className="grid grid-cols-4 gap-4">
          {/* Car Card Section */}
          <div className="col-span-3">
            <CarCard />
          </div>

          {/* Filter Section */}
          <div className="col-span-1 p-4 rounded-lg shadow-lg bg-dark-secondary backdrop-blur-lg md:sticky md:top-20">
            <Filter />
          </div>
        </div>
      </motion.div>
    </div>
  );
}

export default Recommendations;
