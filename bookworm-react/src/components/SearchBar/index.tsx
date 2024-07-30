import MagnifyingGlass from 'components/icons/MagnifyingGlass';
import React, { useEffect, useRef } from 'react';
import 'styles/components/SearchBar.scss';

type Props = {
    search: string;
    placeholder: string;
    onSearchChange: (value: string) => void;
    onSubmitSearch: (...args: any[]) => any;
}

const SearchBar = ({ search, placeholder, onSearchChange, onSubmitSearch }: Props) => {
    const handleKeyUp = (e: React.KeyboardEvent<HTMLInputElement>) => {
        if (e.key === 'Enter') {
            onSubmitSearch();
        }
    }

    const handleSearch = (value: string) => {
        onSearchChange(value)
    }

    return (
        <div className="SearchBar">
            <div className="icon">
                <MagnifyingGlass />
            </div>
            <div className="input w-5/6">
                <input
                    type='text'
                    placeholder={placeholder}
                    value={search}
                    onChange={(e) => handleSearch(e.target.value)}
                    onKeyUp={handleKeyUp} />
            </div>
            <div className="button">
                <button onClick={onSubmitSearch}>Go</button>
            </div>
        </div>
    )
}

export default SearchBar