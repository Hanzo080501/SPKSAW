import axios from 'axios';

const fetchDetails = async (id) => {
  try {
    const response = await axios.get(`http://127.0.0.1:8000/api/car/${id}`); // Ganti dengan URL API Anda
    return response.data;
  } catch (error) {
    throw new Error('Failed to fetch cars: ' + error.message);
  }
};

export { fetchDetails };
