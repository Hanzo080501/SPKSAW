import { useState, useEffect } from 'react';
import { motion, AnimatePresence } from 'framer-motion';
import { fetchCars } from '../api/Api';

function Carousel() {
  const [images, setImages] = useState([]); // State untuk menyimpan gambar
  const [currentIndex, setCurrentIndex] = useState(0);

  // Mengambil gambar dari API saat komponen dimuat
  useEffect(() => {
    fetchCars()
      .then((data) => {
        const serverUrl = 'http://localhost:8000/storage/';
        setImages(data.data.map((car) => serverUrl + car.image));
      })
      .catch((error) => {
        console.error('Error fetching images:', error);
      });
  }, []); // Hanya dijalankan sekali saat komponen dimuat

  // Mengatur timer untuk mengganti gambar
  useEffect(() => {
    if (images.length > 0) {
      const timer = setInterval(() => {
        setCurrentIndex((prevIndex) => (prevIndex + 1) % images.length);
      }, 5000);

      // Membersihkan timer saat komponen dilepas
      return () => clearInterval(timer);
    }
  }, [images]); // Bergantung pada images, hanya berjalan jika images tersedia

  return (
    <div className="relative h-screen overflow-hidden">
      <AnimatePresence mode="wait">
        {images.length > 0 && (
          <motion.img
            key={currentIndex} // Gunakan currentIndex sebagai key
            src={images[currentIndex]} // Mengambil gambar dari state
            initial={{ opacity: 0 }}
            animate={{ opacity: 1 }}
            exit={{ opacity: 0 }}
            transition={{ duration: 0.8, ease: 'easeInOut', delay: 0.4 }}
            className="absolute inset-0 w-full h-full object-cover"
          />
        )}
      </AnimatePresence>
      <div className="absolute inset-0 bg-gradient-to-b from-transparent to-dark-primary" />
      <div className="absolute inset-0 flex items-center justify-center">
        <motion.h1
          initial={{ y: 100, opacity: 0 }}
          animate={{ y: 0, opacity: 1 }}
          className="text-6xl font-bold text-white text-center">
          The Future of Driving
        </motion.h1>
      </div>
    </div>
  );
}

export default Carousel;
