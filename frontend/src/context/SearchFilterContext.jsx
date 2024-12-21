import PropTypes from 'prop-types';
import { createContext, useState } from 'react';

// Context
export const SearchFilterContext = createContext();

// Provider
export function SearchFilterProvider({ children }) {
  const [searchQuery, setSearchQuery] = useState('');
  const [selectedPriceRange, setSelectedPriceRange] = useState('');

  return (
    <SearchFilterContext.Provider
      value={{
        searchQuery,
        setSearchQuery,
        selectedPriceRange,
        setSelectedPriceRange,
      }}>
      {children}
    </SearchFilterContext.Provider>
  );
}

SearchFilterProvider.propTypes = {
  children: PropTypes.node.isRequired,
};
