import { motion } from 'framer-motion';
import Carousel from '../components/Carousel';

function Home() {
  return (
    <div>
      <Carousel />
      <motion.section
        initial={{ opacity: 0, y: 50 }}
        animate={{ opacity: 1, y: 0 }}
        className="max-w-7xl mx-auto px-4 py-16">
        <h2 className="text-4xl font-bold mb-8">Why Electric?</h2>
        <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
          <div className="p-6 bg-dark-secondary rounded-lg">
            <h3 className="text-xl font-semibold mb-4">Eco-Friendly</h3>
            <p className="text-gray-400">Zero emissions for a cleaner future</p>
          </div>
          <div className="p-6 bg-dark-secondary rounded-lg">
            <h3 className="text-xl font-semibold mb-4">Cost-Effective</h3>
            <p className="text-gray-400">Lower maintenance and running costs</p>
          </div>
          <div className="p-6 bg-dark-secondary rounded-lg">
            <h3 className="text-xl font-semibold mb-4">Performance</h3>
            <p className="text-gray-400">Instant torque and smooth acceleration</p>
          </div>
        </div>
      </motion.section>
    </div>
  );
}

export default Home;
