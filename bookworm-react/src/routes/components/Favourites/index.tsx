import ListResults from 'components/ListResults';
import SearchResults from 'components/SearchResults';
import fakerBooks from 'faker/fakerBooks';
import { useState } from 'react';
import { useNavigate, useParams } from 'react-router-dom';
import { Book } from 'types/books.t';
import SearchBar from '../../../components/SearchBar';
import Content from '../../../components/theme/Content';

const Favourites = () => {
    const navigate = useNavigate();
    const { id } = useParams();
    const [search, setSearch] = useState<string>('');
    /**
     * TODO: replace when API calls are working
     */
    const booksCurrentFavourites = fakerBooks(12, 0);
    const booksSearchResults = fakerBooks(12, 12);

    const handleClick = (book: Book) => {
        navigate(`/favourite/${book.id}`);
    };

    return (
        <Content id='favourites'>

            <SearchResults
                results={booksSearchResults}
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

                        <ListResults results={booksCurrentFavourites} />
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