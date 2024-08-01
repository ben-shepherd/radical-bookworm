import SearchResults from 'components/SearchResults';
import useFavouriteBooks from 'hooks/Books/useFavouriteBooks';
import { useCallback, useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { Book } from 'types/books.t';
import Gallery from '../../../components/Gallery';
import SearchBar from '../../../components/SearchBar';
import Content from '../../../components/theme/Content';
import useFetchBooks from '../../../hooks/Books/useFetchBooks';

const Home = () => {
    const navigate = useNavigate();
    
    const [search, setSearch] = useState<string>('');
    const { books: booksSearchResults, loading: loadingSearchResults, refresh: refreshSearch } = useFetchBooks()
    
    const { books: booksBestSellers, loading: loadingBooksBestSellers } = useFetchBooks({ autoload: true })
    const { books: booksFavourites, loading: loadingBooksFavourites } = useFavouriteBooks()

    const handleClick = (book: Book) => {
        navigate(`/edit/${book._id}`);
    }

    const handleSearch = useCallback(() => {
        refreshSearch({ search, resultsEmptyWhenSearchEmpty: true });
    }, [search, refreshSearch])

    const searchBarComponent = useCallback(() => {
        return (
            <SearchBar
                search={search}
                onSearchChange={(value) => setSearch(value)}
                onSubmitSearch={handleSearch}
                placeholder='What books would you like to find?'
                loading={loadingSearchResults}
            />
        )
    }, [search, loadingSearchResults, handleSearch])();

    return (
        <Content id='home'>

            <SearchResults
                results={booksSearchResults}
                onClick={handleClick}
                PreSearchComponent={
                    <div className='pre-search'>
                       {searchBarComponent}

                        <div className='my-10'></div>

                        <h1 className='heading-1 mb-10'>New York Best Sellers</h1>
                        <Gallery data={booksBestSellers} loading={loadingBooksBestSellers} onClick={handleClick} />

                        <div className='my-10'></div>

                        <h1 className='heading-1 mb-10'>Favourites</h1>
                        {loadingBooksFavourites || booksFavourites.length ? (
                            <Gallery data={booksFavourites} loading={loadingBooksFavourites} onClick={handleClick} />
                        ) : (
                            <p className='no-results mt-5'>You have not added any books to your favourites.</p>
                        )}
                        
                    </div>
                }
                PostSearchComponent={(searchResultsComponent) => (
                    <div className='post-search'>
                        <h1 className='heading-1 mb-10'>New York Best Sellers</h1>

                        {searchBarComponent}

                        <div className="mb-10"></div>

                        {searchResultsComponent}
                    </div>
                )}
            />
            
        </Content>
    )
}

export default Home