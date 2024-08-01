import Gallery from 'components/Gallery';
import SearchResults from 'components/SearchResults';
import useFavouriteBooks from 'hooks/Books/useFavouriteBooks';
import { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { Book } from 'types/books.t';
import SearchBar from '../../../components/SearchBar';
import Content from '../../../components/theme/Content';

const Favourites = () => {
    const navigate = useNavigate();
    const [search, setSearch] = useState<string>('');

    const { books: booksFavourites, loading, refresh } = useFavouriteBooks();

    const filteredBooks = search.length 
        ? booksFavourites.filter((book) => book.title.includes(search) || book.description.includes(search) || book.authors.includes(search))
        : booksFavourites;

    const handleClick = (book: Book) => {
        navigate(`/edit/${book._id}`);
    };

    return (
        <Content id='favourites'>

            <SearchResults
                results={filteredBooks}
                onClick={handleClick}
                PreSearchComponent={
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
                            <Gallery loading={loading} maxItems={6} onClick={handleClick} data={[]} />
                        )}
                        {!loading && booksFavourites.length === 0 && (
                            <p className='no-results mt-5'>You have not added any books to your favourites.</p>
                        )}

                    </div>
                }
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