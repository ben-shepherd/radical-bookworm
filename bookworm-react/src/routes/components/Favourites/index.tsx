import Api from 'api/Api';
import ErrorThrower from 'api/ErrorThrower';
import SearchResults from 'components/SearchResults';
import useCreateBook from 'hooks/Books/useCreateBook';
import useFavouriteBooks from 'hooks/Books/useFavouriteBooks';
import { enqueueSnackbar } from 'notistack';
import { useMemo, useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { Book } from 'types/books.t';
import ListResultsLoading from "../../../components/ListResults/ListResultsLoading";
import SearchBar from '../../../components/SearchBar';
import Content from '../../../components/theme/Content';

const Favourites = () => {
    const navigate = useNavigate();
    const [search, setSearch] = useState<string>('');

    const { createBook } = useCreateBook()

    const {books: booksFavourites, loading, refresh} = useFavouriteBooks();

    const filteredBooks = useMemo(() => {
        return search.length
            ? booksFavourites.filter((book) => book.title.includes(search) || book.description.includes(search) || book.authors.includes(search))
            : booksFavourites;
    }, [search, booksFavourites]);

    const handleClick = async (book: Book) => {
        const response = await createBook(book);

        if(response.ok) {
            navigate(`/edit/${response.json._id}`);
        }
    };

    const handleDelete = async (book: Book) => {
        if(!book._id) return;

        const response = ErrorThrower(
            await Api<{success: true}>(`books/${book._id}`, {
                method: 'DELETE'
            })
        )

        if(response.ok) {
            enqueueSnackbar({message: 'Book has been deleted!', variant: 'success'})
            refresh()
        }
    }

    return (
        <Content id='favourites'>

            <SearchResults
                results={filteredBooks}
                onClick={handleClick}
                onRefresh={refresh}
                onEdit={handleClick}
                onDelete={handleDelete}
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