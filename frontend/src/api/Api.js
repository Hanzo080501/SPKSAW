// src/api/CarApi.js
import axios from 'axios';

const fetchCars = async () => {
  try {
    const response = await axios.get(`http://127.0.0.1:8000/api/cars`); // Ganti dengan URL API Anda
    return response.data;
  } catch (error) {
    throw new Error('Failed to fetch cars: ' + error.message);
  }
};

export { fetchCars };
