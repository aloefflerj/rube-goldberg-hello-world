export default function ReactComponent(
    { children, title }: { children: JSX.Element | JSX.Element[], title: String }
) {
    return (
        <>
            <div className='react-box' style={{
                backgroundColor: '#61DAFB',
                width: '100%',
                height: '100%',
            }}>
                <div className='header' style={{
                    display: 'flex',
                    justifyContent: 'center',
                    alignItems: 'center',
                    height: '10%',
                    padding: '0',
                    margin: '0',
                    backgroundColor: '#51afe6',
                }}>
                    <h2 style={{
                        padding: '0',
                        margin: '0',
                        color: '#2d6ba5',
                    }}>{title}</h2>
                </div>
                <div className="body" style={{
                    width: '100%',
                    height: '90%',
                    display: 'grid',
                    gap: '20px',
                    gridTemplateColumns: '1fr 1fr 1fr 1fr',
                    gridTemplateRows: '1fr 1fr 1fr 1fr',
                    padding: '20px',
                    boxSizing: 'border-box',
                }}>
                    {children}
                </div>
            </div>
        </>
    );
}