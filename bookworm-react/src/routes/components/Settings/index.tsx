import fakerBooks from 'faker/fakerBooks';
import { useCallback, useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { Book } from 'types/books.t';
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
            
            <div className="mb-10"></div>

            <h1 className='heading-1'>Settings</h1>

            <div className="mb-10"></div>

            <p>Some content here</p>

        </Content>
    )
}

export default Home