import SearchResults from 'components/SearchResults';
import useFavouriteBooks from 'hooks/Books/useFavouriteBooks';
import {useMemo, useState} from 'react';
import {useNavigate} from 'react-router-dom';
import {Book} from 'types/books.t';
import SearchBar from '../../../components/SearchBar';
import Content from '../../../components/theme/Content';
import ListResultsLoading from "../../../components/ListResults/ListResultsLoading";

const Favourites = () => {
    const navigate = useNavigate();
    const [search, setSearch] = useState<string>('');

    const {books: booksFavourites, loading, refresh} = useFavouriteBooks();

    const filteredBooks = useMemo(() => {
        return search.length
            ? booksFavourites.filter((book) => book.title.includes(search) || book.description.includes(search) || book.authors.includes(search))
            : booksFavourites;
    }, [search, booksFavourites]);

    const handleClick = (book: Book) => {
        navigate(`/edit/${book._id}`);
    };

    return (
        <Content id='favourites'>

            <SearchResults
                results={filteredBooks}
                onClick={handleClick}
                onRefresh={refresh}
                PreSearchComponent={() => (
                    <div className='pre-search'>

                        <h1 className='heading-1 mb-10'>Favourites</h1>

                        <div className='my-10'></div>

                        <SearchBar
                            search={search}
                            onSearchChange={(value) => setSearch(value)}
                            onSubmitSearch={() => null}
                            placeholder='Search'
                        />

                        <div className='my-10'></div>

                        {loading && (
                            <ListResultsLoading maxItems={2}/>
                        )}
                        {!loading && booksFavourites.length === 0 && (
                            <p className='no-results mt-5'>You have not added any books to your favourites.</p>
                        )}

                    </div>
                )}
                PostSearchComponent={(searchResultsComponent) => (
                    <div className='post-search'>

                        <h1 className='heading-1 mb-10'>Favourites</h1>

                        <div className='my-10'></div>

                        <SearchBar
                            search={search}
                            onSearchChange={(value) => setSearch(value)}
                            onSubmitSearch={() => null}
                            placeholder='Search'
                        />

                        <div className='my-10'></div>

                        {searchResultsComponent}
                    </div>
                )}
            />

        </Content>
    )
}

export default Favourites