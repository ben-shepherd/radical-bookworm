import SearchResults from 'components/SearchResults';
import fakerBooks from 'faker/fakerBooks';
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
    /**
     * TODO: replace when API calls are working
     */
    const { /*books: booksBestSellers,*/ refresh: refreshBooksBestSellers } = useFetchBooks({})
    // const { books: booksFavourites } = useFetchBooks({ search })
    // const booksBestSellers = fakerBooks(12, 0)
    const booksBestSellers = fakerBooks(16, 0)
    // const booksBestSellers: Book[] = [];
    const booksFavourites = fakerBooks(16, 16)

    const handleClick = (book: Book) => {
        navigate(`/favourite/${book.id}`);
    }

    const searchBarComponent = useCallback(() => {
        return (
            <SearchBar
                search={search}
                onSearchChange={(value) => setSearch(value)}
                onSubmitSearch={refreshBooksBestSellers}
                placeholder='What books would you like to find?'
            />
        )
    }, [search, refreshBooksBestSellers])();

    return (
        <Content id='home'>

            <SearchResults
                results={booksBestSellers}
                onClick={handleClick}
                PreSearchComponent={
                    <div className='pre-search'>
                       {searchBarComponent}

                        <div className='my-10'></div>

                        <h1 className='heading-1 mb-10'>New York Best Sellers</h1>
                        <Gallery data={booksBestSellers} />

                        <h1 className='heading-1'>Favourites</h1>
                        <Gallery data={booksFavourites} />
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