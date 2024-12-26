import { useContext } from 'react';
import { SearchFilterContext } from '../context/SearchFilterContext';

const Filter = () => {
  const {
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
    handleApplyFilter,
    clearFilters,
    formatToIDR,
  } = useContext(SearchFilterContext);

  const handleMinPriceChange = (e) =>
    setSelectedPriceRange((prev) => ({ ...prev, min: e.target.value }));
  const handleMaxPriceChange = (e) =>
    setSelectedPriceRange((prev) => ({ ...prev, max: e.target.value }));

  return (
    <div className="w-full p-4 mt-4 bg-opacity-50 md:mt-0">
      <h3 className="mb-4 text-xl font-bold">Filter</h3>

      {/* Min Price Slider */}
      <div className="mb-4">
        <label htmlFor="minPrice" className="block text-sm font-medium">
          Min Price
        </label>
        <input
          type="range"
          id="minPrice"
          min="0"
          max="1000000000"
          step="10000000"
          value={selectedPriceRange.min}
          onChange={handleMinPriceChange}
          className="w-full mt-1"
        />
        <div className="flex justify-between text-sm">
          <span>{formatToIDR(selectedPriceRange.min)}</span>
          <span>Min</span>
        </div>
      </div>

      {/* Max Price Slider */}
      <div className="mb-4">
        <label htmlFor="maxPrice" className="block text-sm font-medium">
          Max Price
        </label>
        <input
          type="range"
          id="maxPrice"
          min="0"
          max="1000000000"
          step="10000000"
          value={selectedPriceRange.max}
          onChange={handleMaxPriceChange}
          className="w-full mt-1"
        />
        <div className="flex justify-between text-sm">
          <span>{formatToIDR(selectedPriceRange.max)}</span>
          <span>Max</span>
        </div>
      </div>

      {/* Additional Filters */}
      <div className="mb-4">
        <label htmlFor="batteryType" className="block text-sm font-medium">
          Battery Type
        </label>
        <select
          id="batteryType"
          value={batteryType}
          onChange={(e) => setBatteryType(e.target.value)}
          className="w-full mt-1">
          <option value="">Select Battery Type</option>
          <option value="lithium-ion">Li-ion</option>
          <option value="lithium-iron">Li-iron</option>
          <option value="lithium-polymer">Li-polymer</option>
          <option value="lithium-metal">Li-metal</option>
          <option value="lithium-sulfur">Li-sulfur</option>
          <option value="lead-acid">Lead-acid</option>
          <option value="nickel-cadmium">Ni-cadmium</option>
        </select>
      </div>

      <div className="mb-4">
        <label htmlFor="driveType" className="block text-sm font-medium">
          Drive Type
        </label>
        <select
          id="driveType"
          value={driveType}
          onChange={(e) => setDriveType(e.target.value)}
          className="w-full mt-1">
          <option value="">Select Drive Type</option>
          <option value="AWD">AWD</option>
          <option value="FWD">FWD</option>
          <option value="RWD">RWD</option>
        </select>
      </div>

      <div className="flex mb-4 space-x-3">
        <input
          type="checkbox"
          id="spareParts"
          checked={spareParts}
          onChange={(e) => setSpareParts(e.target.checked)}
          className="mt-1"
        />
        <label htmlFor="spareParts" className="text-sm font-medium">
          Spare Parts
        </label>
      </div>

      <div className="flex mb-4 space-x-3">
        <input
          type="checkbox"
          id="physicalDealer"
          checked={physicalDealer}
          onChange={(e) => setPhysicalDealer(e.target.checked)}
          className="mt-1"
        />
        <label htmlFor="physicalDealer" className="text-sm font-medium">
          Physical Dealer
        </label>
      </div>

      <div className="mb-4">
        <label htmlFor="topSpeed" className="block text-sm font-medium">
          Top Speed
        </label>
        <input
          type="number"
          id="topSpeed"
          value={topSpeed}
          onChange={(e) => setTopSpeed(e.target.value)}
          className="w-full mt-1"
        />
      </div>

      <div className="mb-4">
        <label htmlFor="mileage" className="block text-sm font-medium">
          Mileage
        </label>
        <input
          type="number"
          id="mileage"
          value={mileage}
          onChange={(e) => setMileage(e.target.value)}
          className="w-full mt-1"
        />
      </div>

      <div className="mb-4">
        <label htmlFor="chargingTime" className="block text-sm font-medium">
          Charging Time
        </label>
        <input
          type="number"
          id="chargingTime"
          value={chargingTime}
          onChange={(e) => setChargingTime(e.target.value)}
          className="w-full mt-1"
        />
      </div>

      {/* Apply and Clear Filters Buttons */}
      <div className="mt-6 space-y-4">
        <button
          onClick={handleApplyFilter}
          disabled={isLoading}
          className={`w-full px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600 ${
            isLoading ? 'opacity-50' : ''
          }`}>
          {isLoading ? 'Applying Filter...' : 'Apply Filter'}
        </button>

        <button
          onClick={clearFilters}
          disabled={isLoading}
          className={`w-full px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600 ${
            isLoading ? 'opacity-50' : ''
          }`}>
          {isLoading ? 'Clearing Filters...' : 'Clear Filters'}
        </button>
      </div>
    </div>
  );
};

export default Filter;
