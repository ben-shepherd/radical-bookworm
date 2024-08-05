import SearchResults from 'components/SearchResults';
import useBestSellers from 'hooks/Books/useBestSellers';
import useCreateBook from 'hooks/Books/useCreateBook';
import useFavouriteBooks from 'hooks/Books/useFavouriteBooks';
import useBestSellerSearchResults from 'hooks/Books/useSearchBooks';
import { enqueueSnackbar } from "notistack";
import { useCallback, useEffect, useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { Book } from 'types/books.t';
import Gallery from '../../../components/Gallery';
import ReturnToLink from "../../../components/ReturnToLink";
import SearchBar from '../../../components/SearchBar';
import Content from '../../../components/theme/Content';

const Home = () => {

    const navigate = useNavigate();

    const [search, setSearch] = useState<string>('');

    const { createBook } = useCreateBook()

    const {
        books: booksSearchResults,
        loading: loadingSearchResults,
        refresh: refreshSearch,
        setBooks: setSearchedBooks
    } = useBestSellerSearchResults()

    const { books: booksBestSellers, loading: loadingBooksBestSellers, refresh: refreshBestSellers } = useBestSellers()

    const {
        books: booksFavourites,
        loading: loadingBooksFavourites,
        refresh: refreshBooksFavourites
    } = useFavouriteBooks()

    const handleClick = async (book: Book) => {
        const response = await createBook(book);

        if (response.ok) {
            navigate(`/edit/${response.json.id}`);
        }
    }

    const handleClearSearch = () => {
        setSearch('')
        setSearchedBooks([]);
        refreshBooksFavourites()
    }

    const handleSearch = useCallback(async () => {
        const response = await refreshSearch({ search, resultsEmptyWhenSearchEmpty: true })

        if (Array.isArray(response.json) && response.json.length === 0) {
            enqueueSnackbar({ message: 'No books found!', variant: 'error' })
        }
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

    useEffect(() => {
        refreshBestSellers();
        refreshBooksFavourites();
    }, []);

    return (
        <Content id='home'>

            <SearchResults
                results={booksSearchResults}
                onClick={handleClick}
                PreSearchComponent={() => (
                    <div className='pre-search'>
                        {searchBarComponent}

                        <div className='my-10'></div>

                        <h1 className='heading-1 mb-10'>New York Best Sellers</h1>
                        <Gallery data={booksBestSellers} loading={booksSearchResults.length === 0 && loadingBooksBestSellers} onClick={handleClick} />

                        <div className='my-10'></div>

                        <h1 className='heading-1 mb-10'>Favourites</h1>
                        {loadingBooksFavourites || booksFavourites.length ? (
                            <Gallery data={booksFavourites} loading={loadingBooksFavourites} onClick={handleClick} />
                        ) : (
                            <p className='no-results mt-5'>You have not added any books to your favourites.</p>
                        )}

                    </div>
                )}
                PostSearchComponent={(searchResultsComponent) => (
                    <div className='post-search'>
                        <h1 className='heading-1 mb-10'>New York Best Sellers</h1>

                        {searchBarComponent}

                        <div className="mb-10"></div>

                        {searchResultsComponent}

                        <div className="mb-10"></div>

                        <ReturnToLink url={'/'} text={'Home'} onClick={handleClearSearch} />
                    </div>
                )}
            />

        </Content>
    )
}

export default Home