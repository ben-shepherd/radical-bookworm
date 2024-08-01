import MagnifyingGlass from 'components/icons/MagnifyingGlass';
import React from 'react';
import 'styles/components/SearchBar.scss';

type Props = {
    search: string;
    placeholder: string;
    loading?: boolean;
    loadingText?: string;
    onSearchChange: (value: string) => void;
    onSubmitSearch: (...args: any[]) => any;
}

const SearchBar = ({ search, placeholder, loading = false, loadingText = 'Loading...', onSearchChange, onSubmitSearch }: Props) => {
    const handleKeyUp = (e: React.KeyboardEvent<HTMLInputElement>) => {
        if (e.key === 'Enter') {
            handleSubmitSearch();
        }
    }

    const handleSubmitSearch = () => {
        if(loading) {
            return;
        }

        onSubmitSearch();
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
                    onChange={(e) => onSearchChange(e.target.value)}
                    onKeyUp={handleKeyUp} />
            </div>
            <div className="button">
                <button onClick={handleSubmitSearch}>{loading ? loadingText : 'Go'}</button>
            </div>
        </div>
    )
}

export default SearchBar