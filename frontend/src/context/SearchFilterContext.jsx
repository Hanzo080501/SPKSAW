import PropTypes from 'prop-types';
import { createContext, useState } from 'react';
import axios from 'axios';

// Context
export const SearchFilterContext = createContext();

// Provider
export function SearchFilterProvider({ children }) {
  const [searchQuery, setSearchQuery] = useState('');
  const [selectedPriceRange, setSelectedPriceRange] = useState({ min: 0, max: 1000000000 });
  const [batteryType, setBatteryType] = useState('');
  const [driveType, setDriveType] = useState('');
  const [mileage, setMileage] = useState('');
  const [topSpeed, setTopSpeed] = useState('');
  const [chargingTime, setChargingTime] = useState('');
  const [spareParts, setSpareParts] = useState(false);
  const [physicalDealer, setPhysicalDealer] = useState(false);
  const [isLoading, setIsLoading] = useState(false);
  const [filteredCars, setFilteredCars] = useState([]);

  // Fungsi untuk clear semua filter
  const clearFilters = () => {
    setSearchQuery('');
    setSelectedPriceRange({ min: 0, max: 1000000000 });
    setBatteryType('');
    setDriveType('');
    setMileage('');
    setTopSpeed('');
    setChargingTime('');
    setSpareParts(false);
    setPhysicalDealer(false);
    setFilteredCars([]); // Reset mobil yang sudah difilter
  };

  // Fungsi untuk format harga ke IDR
  const formatToIDR = (value) => {
    return new Intl.NumberFormat('id-ID', {
      style: 'currency',
      currency: 'IDR',
      minimumFractionDigits: 0,
    }).format(value);
  };

  // Fungsi untuk menerapkan filter
  const handleApplyFilter = async () => {
    const { min, max } = selectedPriceRange;

    if (min > max) {
      alert('Harga minimum tidak boleh lebih besar dari harga maksimum');
      return;
    }

    const filterData = {
      price_min: min,
      price_max: max,
      jenis_battery: batteryType || undefined,
      jenis_penggerak: driveType || undefined,
      jarak_tempuh: mileage || undefined,
      top_speed: topSpeed || undefined,
      charging_time: chargingTime || undefined,
      suku_cadang: spareParts ? 1 : 0,
      dealer_fisik: physicalDealer ? 1 : 0,
    };

    const filteredData = Object.fromEntries(
      Object.entries(filterData).filter(([, value]) => value !== undefined)
    );

    try {
      setIsLoading(true);
      const response = await axios.post('http://127.0.0.1:8000/api/filter', filteredData);

      const adjustFilteredData = response.data.ranking.map((car) => {
        let adjustedCar = { ...car };

        if (topSpeed && adjustedCar.top_speed < topSpeed) {
          adjustedCar.top_speed = topSpeed;
        }

        if (chargingTime && adjustedCar.charging_time > chargingTime) {
          adjustedCar.charging_time = chargingTime;
        }

        if (mileage && adjustedCar.range < mileage) {
          adjustedCar.range = mileage;
        }

        return adjustedCar;
      });

      setFilteredCars(adjustFilteredData);
      console.log(adjustFilteredData);
      setIsLoading(false);
    } catch (error) {
      console.error('Terjadi kesalahan saat menerapkan filter:', error);
    } finally {
      setIsLoading(false);
    }
  };

  return (
    <SearchFilterContext.Provider
      value={{
        searchQuery,
        setSearchQuery,
        selectedPriceRange,
        setSelectedPriceRange,
        batteryType,
        setBatteryType,
        driveType,
        setDriveType,
        mileage,
        setMileage,
        topSpeed,
        setTopSpeed,
        chargingTime,
        setChargingTime,
        spareParts,
        setSpareParts,
        physicalDealer,
        setPhysicalDealer,
        isLoading,
        setIsLoading,
        formatToIDR,
        handleApplyFilter,
        clearFilters, // Menyediakan fungsi untuk clear filter
        filteredCars,
      }}>
      {children}
    </SearchFilterContext.Provider>
  );
}

SearchFilterProvider.propTypes = {
  children: PropTypes.node.isRequired,
};
